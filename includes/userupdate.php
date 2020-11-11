<?
namespace Foolery;
use \Foolery\Member;
use \Foolery\DataSource;

session_start();

if (! empty($_POST["update"])) {
  $fName = filter_var($_POST["Fname"], FILTER_SANITIZE_STRING);
  $lName = filter_var($_POST["Lname"], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
  if (isset($_POST["address"]) || isset($_POST["city"]) || isset($_POST["state"]) || isset($_POST["dob"])){
    $address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
    $state = filter_var($_POST["state"], FILTER_SANITIZE_STRING);
    $dob = filter_var($_POST["dob"], FILTER_SANITIZE_STRING);
  }
  if (isset($_POST["company"])){
    $company = filter_var($_POST["company"], FILTER_SANITIZE_STRING);
  }
  require_once "../backend/member.php";
  require_once "../backend/DataSource.php";
  $ds = new DataSource();

  if ($_SESSION["isRetailer"]){
    $updates = array('FName'=>$fName, 'LName'=>$lName, 'Email'=>$email, 'Company'=>$company);
    $table = "retailers";
  }else{
    $updates = array('FName'=>$fName, 'LName'=>$lName, 'Email'=>$email, 'address'=>$address, 'city'=>$city, 'state'=>$state, 'DOB'=>$dob);
    $table = "users";
  }
    
  $member = new Member();
  $changed=0;


  foreach ($updates as $key=>$value){
    if (!empty($value)){
      $updated = $member -> updateUser($table, $key, $value);
      $changed += $updated;
    }else{ $changed+=0; }
  }

  if ($changed > 0){
    $_SESSION['successMessage'] = "Your account details have been updated";

    
    if ($_SESSION["isRetailer"]){
      $query = "SELECT * FROM retailers WHERE id = ?";
    }else{
      $query = "SELECT * FROM users WHERE id = ?";
    }

    $paramType = "i";
    $paramArray = [$_SESSION['id']];
    $stmt = $ds->select($query, $paramType, $paramArray);
    echo "<pre>";print_r($stmt[0]);echo "</pre>";
    echo "<pre>";print_r($_SESSION);echo "</pre>";

    $_SESSION["id"] = $stmt[0]["id"];
    $_SESSION["user"] = $stmt[0]["FName"];
    $_SESSION["MemberName"] = $stmt[0]["FName"]." ".$stmt[0]["LName"];
    $_SESSION["Email"] = $stmt[0]["Email"];

    if (!$_SESSION["isRetailer"]){
      $_SESSION["Address"] = $stmt[0]["address"]." ".$stmt[0]["city"].", ".$stmt[0]["state"];
      $_SESSION["DOB"] = $stmt[0]["DOB"];
    }else{
      $_SESSION['Company'] = $stmt[0]["Company"];
    }
    
  }else {
    $_SESSION['errorMessage'] = "OH NO! Our hamsters got stuck on the wheel, we couldn't update your information.";
  }

  if ($_SESSION['isRetailer']){
    header("Location: ../retailer.php");
  }else{
    header("Location: ../account.php");
  }
}