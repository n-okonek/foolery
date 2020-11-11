<?
namespace Foolery;
use \Foolery\Datasource;

class Coupon {

  function __construct()
  {
      require_once "DataSource.php";
      $this->ds = new DataSource();
  }

  public function createCoupon($code, $desc, $company){
    $query = "INSERT INTO coupons (code, couponDesc, company) VALUES (?, ?, ?)";
    $paramType = "sss";
    $paramArray = [$code, $desc, $company];
    $stmt = $this->ds->insert($query, $paramType, $paramArray);
    
    if($stmt->affected_rows > 0){
        $_SESSION['successMessage'] = "Your coupon was succesfully created.";
        return true;
    }
  }

  public function updateCoupon($code, $desc, $company){
    $query = "UPDATE coupons SET code = ?, couponDesc = ? WHERE code = ? AND company = ?;";
    $paramType = "ssss";
    $paramArray = [$code, $desc, $code, $company];
    $stmt = $this->ds->execute($query, $paramType, $paramArray);

    $_SESSION['successMessage'] = "Your coupon was succesfully updated.";
      return true;
  }

  public function DeleteCoupon($id){
    $query = "DELETE FROM coupons WHERE id = ?";
    $paramType = "s";
    $paramArray = [$id];
    $stmt = $this->ds->execute($query, $paramType, $paramArray);

    $_SESSION['successMessage'] = "Your coupon was succesfully deleted.";
    return true;
  }

  public function RetrieveCoupons($company){
    $query = "SELECT * FROM coupons WHERE company = ?";
    $paramType = "s";
    $paramArray = [$company];
    $stmt = $this->ds->select($query, $paramType, $paramArray);
    return $stmt;
  }
}