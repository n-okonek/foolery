<?
session_start();
if (!(empty($_POST["userName"]) && empty($_POST["pswd"]))) {
    
    $username = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["pswd"], FILTER_SANITIZE_STRING);
    
    require_once ("../backend/member.php");
    
    $member = new Member();

    $isLoggedIn = $member->processLogin($username, $password);

    if ($isLoggedIn) {
        $_SESSION["LoggedIn"] = true;
        header("Location: ../account.php");
    }else{
        $_SESSION["errorMessage"] = "Invalid Credentials";
        header("Location: ../login.php", true, 403);
    }
}else{
    $_SESSION["errorMessage"] = "Credentials Missing";
    header("Location: ../login.php", true, 403);
} 

?>