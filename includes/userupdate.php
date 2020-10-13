<?
session_start();

if (! empty($_POST["update"])) {
  $fName = filter_var($_POST["Fname"], FILTER_SANITIZE_STRING);
  $lName = filter_var($_POST["Lname"], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
  $dob = filter_var($_POST["dob"], FILTER_SANITIZE_STRING);
  $coo = filter_var($_POST["origin"], FILTER_SANITIZE_STRING);
  require_once ("../backend/member.php");

  $updates = array('FName'=>$fName, 'LName'=>$lName, 'Email'=>$email, 'DOB'=>$dob, 'Origin'=>$coo);
    
  $member = new Member();
  $changed=0;

  foreach ($updates as $key=>$value){
    if (!empty($value)){
      $updated = $member -> updateUser($key, $value);
      $changed += $updated;
    }else{ $changed+=0; }
  }

  if ($changed > 0){
    $_SESSION['successMessage'] = "Your account details have been updated";

    $db = new mysqli('localhost', 'glazpmck_ics370', 'BZgGYMd4BSqTiNb', 'glazpmck_ics370' );

    $query = "SELECT * FROM users WHERE User_ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $_SESSION['userID']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($userID, $email, $fname, $lname, $ps, $dob, $origin, $ac);
        
    while ($stmt->fetch()){
      $_SESSION['userID'] = $userID;
      $_SESSION['user'] = $fname;
      $_SESSION['MemberName'] =$fname." ".$lname;
      $_SESSION['Email'] = $email;
      $_SESSION['DOB'] = $dob;
      $_SESSION['Country'] = $origin;
    }
  }else {
    $_SESSION['errorMessage'] = "OH NO! Our hamsters got stuck on the wheel, we couldn't update your information.";
  }

  header("Location: ../account.php");
}

?>