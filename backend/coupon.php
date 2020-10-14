<?

class Coupon {
  function __construct()
  {
      $this->db = new mysqli('localhost', 'glazpmck_ics370', 'BZgGYMd4BSqTiNb', 'glazpmck_ics370' );
  }

  public function createCoupon($code, $desc, $company){
    $query = "INSERT INTO coupons (code, couponDesc, company) VALUES (?, ?, ?)";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("sss", $code, $desc, $company);
    $stmt->execute();
    
    if($stmt->affected_rows > 0){
        $_SESSION['successMessage'] = "Your coupon was succesfully created.";
        return true;
    }
    $this->db->close();
  }

  public function RetrieveCoupons($company){
    $query = "SELECT * FROM coupons WHERE Company = '?'";
    $rs = $this->db->query($query);
    $results = [];
    if ($rs->num_rows > 0){
      while ($row = $rs->fetch_assoc()){
        $results.push();
      }
    }
    return $results;
  }
}