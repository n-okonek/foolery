<?
session_start();
require_once ("../backend/member.php");
$member = new Member();

if (isset($_POST["reset-request-submit"])) {

  $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);

  $reset_request = $member->PwResetReq($email);
  
  if ($reset_request){
    $_SESSION['successMessage'] = "Please check your email for reset instructions.";
    header("Location: ../login.php");
  }
		
} elseif(isset($_POST['reset-password-submit'])){
  $selector = $_POST["selector"];
	$validator = $_POST["validator"];
	$password = filter_var($_POST["pwd"], FILTER_SANITIZE_STRING);
  $passwordRepeat = filter_var($_POST["pwd-repeat"], FILTER_SANITIZE_STRING);
  
  if (empty($password) || empty($passwordRepeat)) {
    $_SESSION['errorMessage'] = "One or more password fields are empty";
		header("Location: ../login.php?selector=$selector&validator=$validator");
		exit();
  } 
  else if ($password != $passwordRepeat) {
    $_SESSION['errorMessage'] = "Passwords do not match";
		header("Location: ../login.php?selector=$selector&validator=$validator");
		exit();
  }
  
  $reset_pass = $member->ResetPassword($selector, $validator, $password, $passwordRepeat);
  $_SESSION['successMessage'] = "You have successfully changed your password.";
  header ("Location: ../login.php");
  exit();
}
else {
  $_SESSION['errorMessage'] = "The hamsters fell off the wheel, please try again.";
	header("Location: ../login.php");
}
?>