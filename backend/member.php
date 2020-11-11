<?php
namespace Foolery;

use \Foolery\Datasource;

class Member
{
    private $dbConn;

    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }

    function getMemberById($memberId)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $paramType = "i";
        $paramArray = [$memberId];
        $memberResult = $this->ds->select($query, $paramType, $paramArray);

        return $memberResult;
    }

    public function processLogin($username, $password) 
    {
        $passwordHash = md5($password);
        $query = "SELECT * FROM users WHERE Email = ? AND Psword = ?";
        $paramType = "ss";
        $paramArray = [$username, $passwordHash];
        $memberResult = $this->ds->select($query, $paramType, $paramArray);
                
        if(!empty($memberResult))
        {
            $_SESSION['id'] = $memberResult[0]["id"];
            $_SESSION['user'] = $memberResult[0]['FName'];
            $_SESSION['MemberName'] = $memberResult[0]['FName']." ".$memberResult[0]['LName'];
            $_SESSION['MemberSince'] = $memberResult[0]['AccountCreated'];
            $_SESSION['Email'] = $memberResult[0]['Email'];
            $_SESSION['Address'] = $memberResult[0]['address'].", ".$memberResult[0]['city'].", ".$memberResult[0]['state'];
            $_SESSION['DOB'] = $memberResult[0]['DOB'];
            $_SESSION['isRetailer'] = false;
            return true;
        }else
        {
            $query = "SELECT * FROM retailers WHERE Email = ? AND Psword = ?";
            $paramType = "ss";
            $paramArray = [$username, $passwordHash];
            $memberResult = $this->ds->select($query, $paramType, $paramArray);

            if(!empty($memberResult))
            {
                $_SESSION['id'] = $memberResult[0]['id'];
                $_SESSION['user'] = $memberResult[0]['FName'];
                $_SESSION['MemberName'] = $memberResult[0]['FName']." ".$memberResult[0]['LName'];
                $_SESSION['Company'] = $memberResult[0]['Company'];
                $_SESSION['MemberSince'] = $memberResult[0]['AccountCreated'];
                $_SESSION['Email'] = $memberResult[0]['Email'];
                $_SESSION['isRetailer'] = true;
                return true;
            }
        }
    }

    public function createUser($fname, $lname, $email, $pw, $dob, $address, $city, $state)
    {
        $passwordHash = md5($pw);
        $query = "INSERT INTO users (Email, FName, LName, Psword, address, city, state, DOB) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "ssssssss";
        $paramArray = [$email, $fname, $lname, $passwordHash, $address, $city, $state, $dob];
        $stmt = $this->ds->insert($query, $paramType, $paramArray);
                
        if($stmt > 0)
        {
            $this->processLogin($email,$pw);
            $_SESSION['LoggedIn'] = true;
            return true;
        }
    }

    public function updateUser($table, $key, $value)
    {
        $query = "UPDATE $table SET $key = ? WHERE id = ?";
        $paramType = "si";
        $paramArray = [$value, $_SESSION['id']];
        $stmt = $this->ds->execute($query, $paramType, $paramArray);
                
        return 1;
    }

    public function PwResetReq($email)
    {
        $selector = bin2hex(random_bytes(8));
	    $token = random_bytes(32);

        $expires = date("U") + 1800;

        $query = "DELETE FROM pwdreset WHERE pwdResetEmail = ?;";
        $paramType = "s";
        $paramArray = [$email];
	    $stmt = $this->ds->execute($query, $paramType, $paramArray);
        
        $query = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
        $paramType = "ssss";
        $paramArray = [$email, $selector, $hashedToken, $expires];
        $hashedToken = bin2hex($token);
        $stmt = $this->ds->insert($query, $paramType, $paramArray);
        
        $email_reset = $this->SendResetMail($email, $selector, $token);
        if ($email_reset)
        {
            return true;
        }
    }

    public function SendResetMail($email, $selector, $token)
    {
        $to = $email;
        $url = $_SERVER['SERVER_NAME']."/login.php?selector=" . $selector . "&validator=" . bin2hex($token);
		$subject = 'Project Foolery Password Reset Request';
		
		$message  = '<p> We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p>';
		$message .= '<p> Here is your password reset link: </br>';
		$message .= '<a href="' . $url . '">' . $url . '</a></p>';
		
		$headers = "From: Project Foolery <no-reply@ics370.glazedproductions.com>\r\n";
		$headers .= "Reply-To: \r\n";
		$headers .= "Content-type: text/html\r\n";
		
        mail($to, $subject, $message, $headers);
        return true;
    }

    public function ResetPassword($selector, $validator, $password, $passwordRepeat)
    {
	    $currentDate = date("U");
		
        $query = "SELECT * FROM pwdreset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
        $paramType = "ss";
        $paramArray = [$selector, $currentDate];
        $stmt = $this->ds->select($query, $paramType, $paramArray);

        $stmt->store_result();
        $numrows = $stmt->num_rows;
        $stmt->bind_result($pwdResetID, $pwdResetEmail, $pwdResetSelector, $pwdResetToken, $pwdResetExpires);

        if ($numrows <= 0) 
        {
            echo "couldn't pull result set";
            exit();
        }
        else 
        {
            $token = $validator;
                
            while($stmt->fetch())
            {
                if($token == $pwdResetToken){
                    $tokenCheck = true;
                    $tokenEmail = $pwdResetEmail;
                }else{ $tokenCheck = false;}
            }
                
                    //$tokenCheck = password_verify($token, $pwdResetToken);
                
            if($tokenCheck === false) 
            {
                echo "failed token check";
                exit();
            }
            elseif ($tokenCheck === true) 
            {
                $query = "SELECT * FROM users WHERE Email = ?;";
                $paramType ="s";
                $paramArray= [$tokenEmail];
                $stmt =  $this->ds->select($query, $paramType, $paramArray);
                $stmt->store_result();
                $numrows = $stmt->num_rows;
                $stmt->bind_result($User_ID, $Email, $FName, $LName, $Psword, $DOB, $Origin, $AccountCreated);

                if ($numrows <= 0) 
                {
                    echo "couldn't pull user set!";
                    exit();
                }
                else {
                    $newPwdHash = md5($password);
                    $query = "UPDATE users SET Psword=? Where Email = ?";
                    $paramType ="ss";
                    $paramArray= [$newPwdHash, $tokenEmail];
                    $stmt = $this->ds->execute($query, $paramType, $paramArray);
                                        
                    $query = "DELETE FROM pwdreset WHERE pwdResetEmail = ?;";
                    $paramType = "s";
                    $paramArray = [$tokenEmail];
                    $stmt = $this->ds->execute($query, $paramType, $paramArray);
                    $stmt->bind_param("s", $tokenEmail);
                                    
                    return true;
                }
            }
        }
    }
}