<?
namespace Foolery;
use \Foolery\Coupon;

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if ( !empty($_POST["addCoupon"]) ){
  $couponCode = filter_var($_POST["code"], FILTER_SANITIZE_STRING);
  $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
  $company = filter_var($_POST["company"]);
  require_once "../backend/coupon.php";

  $newCoupon = new Coupon();

  if ($couponCode && $description){
    $newCoupon -> createCoupon($couponCode, $description, $company);
    $_SESSION["successMessage"] = "Your coupon has been successfully added";
    header("Location: ../retailer.php");
    exit();
  }else{
    $_SESSION["errorMessage"] = "One or more fields are missing.";
    header("Location: ../retailer.php");
  }
}