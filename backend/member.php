<?php

class Member
{
 private $db;

    function __construct()
    {
        $this->db = new mysqli('localhost', 'glazpmck_ics370', 'BZgGYMd4BSqTiNb', 'glazpmck_ics370' );
    }

    public function processLogin($username, $password) {
        $passwordHash = md5($password);
        $query = "SELECT * FROM users WHERE Email = '$username' AND Psword = '$passwordHash'";
        $result = $this->db->query($query);
        //$result->bind_param("ss", $username, $passwordHash);
        $row=$result->fetch_array(MYSQLI_ASSOC);
        
        if($result->num_rows){
            $_SESSION['userID'] = $row['User_ID'];
            $_SESSION['user'] = $row['FName'];
            $_SESSION['MemberName'] = $row['FName']." ".$row['LName'];
            $_SESSION['MemberSince'] = $row['AccountCreated'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['DOB'] = $row['DOB'];
            $_SESSION['isRetailer'] = false;
            return true;
        }else{
            $query = "SELECT * FROM retailers WHERE Email = '$username' AND Psword = '$passwordHash'";
            $result = $this->db->query($query);
            $row=$result->fetch_array(MYSQLI_ASSOC);

            if($result->num_rows){
                $_SESSION['userID'] = $row['User_ID'];
                $_SESSION['user'] = $row['FName'];
                $_SESSION['MemberName'] = $row['FName']." ".$row['LName'];
                $_SESSION['Company'] = $row['Company'];
                $_SESSION['MemberSince'] = $row['AccountCreated'];
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['isRetailer'] = true;
                return true;
            }
        }
        $this->db->close();
    }

    public function createUser($fname, $lname, $email, $pw, $dob){

        $passwordHash = md5($pw);
        $query = "INSERT INTO users (Email, FName, LName, Psword, DOB) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss", $email,$fname,$lname,$passwordHash,$dob);
        $stmt->execute();
        
        if($stmt->affected_rows > 0){
            $this->processLogin($email,$pw);
            $_SESSION['LoggedIn'] = true;
            return true;
        }
        $this->db->close();
    }

    public function updateUser($key, $value){
        $query = "UPDATE users SET $key = ? WHERE User_ID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $value, $_SESSION['userID']);
        $stmt->execute();
        if ($stmt->affected_rows > 0){
            return 1;
        }else {return 0;}
        $this->db->close();
    }

    public function PwResetReq($email){
        $selector = bin2hex(random_bytes(8));
	    $token = random_bytes(32);

        $expires = date("U") + 1800;

        $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
	    $stmt = $this->db->prepare($sql);
            if (!$this->db) {
                $_SESSION['errorMessage'] = "Our hamster fell off the wheel, please try again.";
                exit();
            } else {
                $stmt->bind_param("s", $email);
                $stmt->execute();
            }
        
        $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
        $stmt = $this->db->prepare($sql);
        if (!$this->db) {
            $_SESSION['errorMessage'] = "Our hamster fell off the wheel, please try again.";
            exit();
        } else {
            $hashedToken = bin2hex($token);
            $stmt->bind_param("ssss", $email, $selector, $hashedToken, $expires);
            $stmt->execute();
        }
        $this->db->close();
        $email_reset = $this->SendResetMail($email, $selector, $token);
        if ($email_reset){
            return true;
        }
    }

    public function SendResetMail($email, $selector, $token){
        
        $to = $email;
        $url = $_SERVER['SERVER_NAME']."/login.php?selector=" . $selector . "&validator=" . bin2hex($token);
		$subject = 'Wanderlust Outpost Password Reset Request';
		
		$message  = '<p> We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email.</p>';
		$message .= '<p> Here is your password reset link: </br>';
		$message .= '<a href="' . $url . '">' . $url . '</a></p>';
		
		$headers = "From: Project Foolery <no-reply@ics370.glazedproductions.com>\r\n";
		$headers .= "Reply-To: \r\n";
		$headers .= "Content-type: text/html\r\n";
		
        mail($to, $subject, $message, $headers);
        return true;
    }

    public function ResetPassword($selector, $validator, $password, $passwordRepeat){

	    $currentDate = date("U");
		
        $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            echo "There was an error!";
            exit();
        } 
    	else {
	    	$stmt->bind_param("ss", $selector, $currentDate);
		    $stmt->execute();
            $stmt->store_result();
            $numrows = $stmt->num_rows;
            $stmt->bind_result($pwdResetID, $pwdResetEmail, $pwdResetSelector, $pwdResetToken, $pwdResetExpires);

		    if ($numrows <= 0) {
			    echo "couldn't pull result set";
			    exit();
		    }
            else {
                $token = $validator;
                
                while($stmt->fetch()){
                    if($token == $pwdResetToken){
                        $tokenCheck = true;
                        $tokenEmail = $pwdResetEmail;
                    }else{ $tokenCheck = false;}
                }
                
                    //$tokenCheck = password_verify($token, $pwdResetToken);
                
                if($tokenCheck === false) {
                    echo "failed token check";
                    exit();
                }
                elseif ($tokenCheck === true) {
                    
                    $sql = "SELECT * FROM users WHERE Email = ?;";
                    $stmt =  $this->db->prepare($sql);
                    
                    if (!$stmt) {
                        echo "There was an error!";
                        exit();
                    } 
                    
                    else {
                        $stmt->bind_param("s", $tokenEmail);
                        $stmt->execute();
                        $stmt->store_result();
                        $numrows = $stmt->num_rows;
                        $stmt->bind_result($User_ID, $Email, $FName, $LName, $Psword, $DOB, $Origin, $AccountCreated);

                        if ($numrows <= 0) {
                            echo "couldn't pull user set!";
                            exit();
                        }
                        
                        else {
                            $sql = "UPDATE users SET Psword=? Where Email=?";
                            $stmt = $this->db->prepare($sql);
                            if (!$stmt) {
                                echo "There was an error!";
                                exit();
                            }
                            
                            else {
                                $newPwdHash = md5($password);
                                $stmt->bind_param("ss", $newPwdHash, $tokenEmail);
                                $stmt->execute();
                                
                                $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
                                $stmt = $this->db->prepare($sql);
                                
                                if (!$stmt) {
                                    echo "There was an error!";
                                    exit();
                                }
                                
                                else {
                                    $stmt->bind_param("s", $tokenEmail);
                                    $stmt->execute();
                                    return true;
                                }
                            }
                        }
                    }
                }
		    }
	    } 	
    } 
}
?>