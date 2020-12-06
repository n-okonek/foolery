<?
namespace Foolery;
use \Foolery\Member;
use \Foolery\DataSource;

session_start();

if (!empty($_POST["upgrade"])) {
  $fName = filter_var($_POST["Fname"], FILTER_SANITIZE_STRING);
  $lName = filter_var($_POST["Lname"], FILTER_SANITIZE_STRING);
  $address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
  $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
  $state = filter_var($_POST["state"], FILTER_SANITIZE_STRING);
  $cardno = filter_var($_POST["card-number"], FILTER_SANITIZE_STRING);
  $exp = filter_var($_POST["exp"], FILTER_SANITIZE_STRING);
  $cvv = filter_var($_POST["cvv"], FILTER_SANITIZE_STRING);
  $filtered_vars=[$fName, $lName, $address, $city, $state, $cardno, $exp, $cvv];

  require_once "../backend/member.php";
  require_once "../backend/DataSource.php";

  $ds = new DataSource();
  $member = new Member();

  $result = $member->upgradeUser($_SESSION["id"]);  

  if($result > 0){
    $_SESSION["isMember"] = true;
  }else{
    echo $member;
  }
}else {
    $_SESSION['errorMessage'] = "OH NO! Our hamsters got stuck on the wheel, we couldn't update your information.";
  }
  
header("Location: ../account.php");