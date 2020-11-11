<?
  namespace Foolery;
  use \Foolery\Coupon;
  
  session_start();
  require_once '../backend/coupon.php';
  if ( !empty($_POST["deleteCoupon"]) ){
    $id = filter_var($_POST["id"], FILTER_SANITIZE_STRING);
    $newCoupon = new Coupon();
    $newCoupon -> DeleteCoupon($id);
    header("Location: ../retailer.php");
    exit();
  }