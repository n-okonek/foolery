<?
session_start();

if (empty($_SESSION['LoggedIn'])){
  $_SESSION["errorMessage"] = "We were not able to identify your account, please log in.";
  header("Location: ./login.php");
}

else{
  require("includes/page.php");

  Class RetailerAccountPage extends Page{

    private $db;

    function __construct()
    {
        $this->db = new mysqli('localhost', 'glazpmck_ics370', 'BZgGYMd4BSqTiNb', 'glazpmck_ics370' );
    }

    public function Display($pageID){
      $this -> DisplayHead(); // includes all meta information including site title and page names
      $this -> DisplayBody();
      $this -> DisplayHeader(); //includes display menu
      $this -> SetPageInfo($pageID);
      echo $this->content;
      $this -> DisplayAccountInfo();
      $this -> DisplayActiveCoupons();
      $this -> DisplayFooter();
      $this -> UpdateUserForm();
      $this -> AddCouponForm();
    }

    private function DisplayAccountInfo(){
      ?>
        <!-- Account info secion -->
        <div class="account-panel">
          <h3><?php echo "Account Information"?></h3>
          <div class ="accountInfo">
              <p><? echo "Member name: ".$_SESSION['MemberName'] ?></p>
              <p><? echo "Member since: ".$_SESSION['MemberSince']  ?></p>
              <p><? echo "Email: ".$_SESSION['Email'] ?></p>
              <p><? echo "Company: ".$_SESSION['Company']?>
          </div>
          <div class="container" id="submit">
              <button type="submit" onclick="showForm('update-user');">Update Profile</button>
          </div>    
        </div>
      <?
    }

    private function DisplayActiveCoupons(){
      require_once('./backend/coupon.php');
      $coupon = new Coupon();
      $rs = $coupon->RetrieveCoupons($_SESSION['Company']);
      while ($rs){
        echo $rs;
      }
      ?>
      <div class="container" id="submit">
        <button type="submit" onclick="showForm('add-coupon');">Update Profile</button>
      </div>  
      <?
    }

    private function AddCouponForm(){
      ?>
      <div class="add-coupon">
        <form id="add-coupon" action="./includes/newcoupon.php" method="post">
          <div class="container" id="add-coupon">
            <label for="code">Coupon Code:</label>
            <input class="form-control" type="text" name="code" id="code" maxLength="24">
            <br />
            <label for="description">Coupon Description:</label>
            <input class="form-control" type="text" name="description" id="description" maxLength="255">
            <input hidden name="company" value="<?=$_SESSION['Company']?>" />
          </div>  
          <div class="container" id="submit">
            <button type="submit" value="addCoupon" name="addCoupon">Add Coupon</button>
          </div>
          <div class="container" id="cancel">
            <div onclick="closeForm('add-coupon')">Cancel</div>
          </div>
        </form>
    </div>
    <?
    }

    private function UpdateUserForm(){
      ?>
      <div class="update-user">
        <form id="update-user" action="./includes/userupdate.php" method="post">
          <div class="container" id="register">
            <label for="Fname">First Name:</label>
            <input class="form-control" type="text" name="Fname" id="Fname" maxLength="24">
            <br />
            <label for="Lname">Last Name:</label>
            <input class="form-control" type="text" name="Lname" id="Lname" maxLength="24">
            <br />
            <label for="email">Email:</label>
            <input class="form-control" type="text" name="email" id="email" maxLength="36">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            <br />
            <label for="company">Company</label>
            <input class="form-control" type="text" name="company" id="company">
            <br />
          </div>
          <div class="container" id="submit">
            <button type="submit" value="update" name="update">Update Profile</button>
          </div>
          <div class="container" id="cancel">
            <div onclick="closeForm('update-user')">Cancel</div>
          </div>
        </form>
    </div>
    <?
    }
  }

  $account = new RetailerAccountPage();

  $account->content ="";

  $account -> Display(6);
}