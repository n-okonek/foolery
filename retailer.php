<?
namespace Foolery;
use \Foolery\Coupon;

session_start();

if (empty($_SESSION['LoggedIn'])){
  $_SESSION["errorMessage"] = "Please log in.";
  header("Location: ./login.php");
}

else{
  require_once "includes/page.php";
  require_once "backend/coupon.php";

  function DisplayAccountInfo(){
    ?>
      <!-- Account info secion -->
      <div class="account-panel">
        <h3><?php echo "Account Information"?></h3>
        <div class ="accountInfo">
            <p><?php echo "Member name: ".$_SESSION['MemberName'] ?></p>
            <p><?php echo "Member since: ".$_SESSION['MemberSince']  ?></p>
            <p><?php echo "Email: ".$_SESSION['Email'] ?></p>
            <p><?php echo "Company: ".$_SESSION['Company'] ?></p>
            <button class="btn btn-primary" type="submit" onclick="showForm('update-user');">Update Profile</button>
        </div>
        
        <? DisplayActiveCoupons(); ?>
      </div>
    <?
  }

  function DisplayActiveCoupons(){
    $coupon = new Coupon();
    $rs = $coupon->RetrieveCoupons($_SESSION['Company']);
    //print_r($rs)
    ?>
    <div class="active-coupons">
    <? if (isset($_SESSION["errorMessage"])){ ?>
      <div class="alert alert-warning coupon-message" role="alert"><?= $_SESSION["errorMessage"];?></div>
    <? unset($_SESSION["errorMessage"]); }
    if (isset($_SESSION["successMessage"])){?>
      <div class="alert alert-success coupon-message" role="alert"><?= $_SESSION["successMessage"]?></div>
      <? unset($_SESSION["successMessage"]);
    } ?>
      <div class="coupon-header c-code">Coupon Code</div>
      <div class="coupon-header c-description">Coupon Description</div>
      <?
        foreach ($rs as $key => $value ){
          ?>
          <div class="btn btn-secondary edit-c" onclick="showEditCoupon('<?=$value['code']?>', '<?=$value['couponDesc']?>')">Edit</div>
          <form action="./includes/deletecoupon.php" id="delete-coupon-<?=$value['id']?>" method="post" onsubmit="return confirm('Are you sure you want to delete this coupon? This action cannot be undone!')">
            <input hidden name="id" value="<?=$value['id']?>" />
            <button class="btn btn-danger delete-c" type="submit" value="deleteCoupon" name="deleteCoupon"><i class="fa fa-trash"></i></button>
          </form>          
          <div class="coupon-code"><?=$value['code']?></div>
          <div class="coupon-description"><?=$value['couponDesc']?></div>
          <?
        }?>
        <div class="btn btn-primary add-c" onclick="showForm('add-coupon');">Add Coupon</div>
    </div>
    
    <?
  }

  function AddCouponForm(){
    ?>
    <div class="add-coupon">
      <div class="background-mask">
        <form id="add-coupon" action="./includes/newcoupon.php" method="post">
          <div class="form-group">
            <label for="code">Coupon Code:</label>
            <input class="form-control" type="text" name="code" id="code" maxLength="24">
          </div>
          <div class="form-group">
            <label for="description">Coupon Description:</label>
            <input class="form-control" type="text" name="description" id="description" maxLength="255">
          </div>
            <input hidden name="company" value="<?=$_SESSION['Company']?>" />
            <button class="btn btn-primary" type="submit" value="addCoupon" name="addCoupon">Add Coupon</button>
            <div class="btn btn-secondary" onclick="closeForm('add-coupon')">Cancel</div>
          </div>
        </form>
      </div>
    </div>
    <?
  }

  function EditCouponForm(){
    ?>
    <div class="edit-coupon">
      <div class="background-mask">
        <form id="edit-coupon" action="./includes/editcoupon.php" method="post">
          <div class="form-group">
            <label for="code">Coupon Code:</label>
            <input class="form-control" readonly type="text" name="code" id="code" maxLength="24">
          </div>
          <div class="form-group">
            <label for="description">Coupon Description:</label>
            <input class="form-control" type="text" name="description" id="description" maxLength="255">
          </div>
            <input hidden id="company" name="company" value="<?=$_SESSION['Company']?>" />
            <button class="btn btn-primary" type="submit" value="editCoupon" name="editCoupon">Edit Coupon</button>
            <div class="btn btn-secondary" onclick="closeForm('edit-coupon')">Cancel</div>
          </div>
        </form>
      </div>
    </div>
    <?
  }

  function UpdateUserForm(){
    ?>
    <div class="update-user">
      <div class="background-mask">
        <form id="update-user" action="./includes/userupdate.php" method="post">
          <div class="form-group">
            <label for="Fname">First Name:</label>
            <input class="form-control" type="text" name="Fname" id="Fname" maxLength="24" />
          </div>
          <div class="form-group">
            <label for="Lname">Last Name:</label>
            <input class="form-control" type="text" name="Lname" id="Lname" maxLength="24" />
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control" type="text" name="email" id="email" maxLength="36" />
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="company">Company:</label>
            <input class="form-control" type="text" name="company" id="company" />
          </div>
          <button class="btn btn-primary" type="submit" value="update" name="update">Update Profile</button>
          <div  class="btn btn-secondary" onclick="closeForm('update-user')">Cancel</div>
        </form>
      </div>
    </div>
    <?
  }



  $account = new Page();
  $account -> content = "";
  $account -> Display(6);
  DisplayAccountInfo();
  UpdateUserForm();
  AddCouponForm();
  EditCouponForm();
}