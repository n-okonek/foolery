<?
namespace Foolery;
use \Foolery\Coupon;

session_start();

if ( !empty($_POST["editCoupon"]) ){
  $couponCode = filter_var($_POST["code"], FILTER_SANITIZE_STRING);
  $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
  $company = filter_var($_POST["company"]);
    require_once ("../backend/coupon.php");

  $newCoupon = new Coupon();

  if ($couponCode && $description){
    $newCoupon -> updateCoupon($couponCode, $description, $company);
    header("Location: ../retailer.php");
    exit();
  }else{
    $_SESSION["errorMessage"] = "One or more fields are missing.";
    header("Location: ../retailer.php");
  }
}