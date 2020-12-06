<?
namespace Foolery;
use \Foolery\Page;
use \Foolery\Member;

require_once "backend/member.php";
require_once "includes/page.php";

session_start();

if (empty($_SESSION['LoggedIn'])){
  $_SESSION["errorMessage"] = "Please log in.";
  header("Location: ./login.php");
}

else{
  function DisplayAccountInfo(){
    ?>
      <!-- Account info secion -->
      <div class="account-panel">
        <h3><?php echo "Account Information"?></h3>
        <div class ="accountInfo">
            <p><?php echo "Member name: ".$_SESSION['MemberName'] ?></p>
            <p><?php echo "Member since: ".$_SESSION['MemberSince']  ?></p>
            <p><?php echo "Email: ".$_SESSION['Email'] ?></p>
            <p><?php echo "Address: ".$_SESSION['Address'] ?></p>
            <p><?php echo "Birthday: ".$_SESSION['DOB'] ?></p>
            <button class="btn btn-primary" type="submit" onclick="showForm('update-user');">Update Profile</button>
        </div>
        <div class="right-panel">
        <?
          if ($_SESSION['isMember']){
            DisplayCoupon();  
          }else{
            DisplayMembership();
          }
        ?>
        </div>
      </div>
    <?
  }

  function DisplayCoupon(){
    $coupon = new Member();
    $rs = $coupon->RetrieveCoupon();
    $display = $rs[rand(0,count($rs)-1)];
    ?>
      <h3 class="centered">A Coupon from <br /><?=$display["company"]?></h3>
      <div class="barcode-container">
        <img src="images/barcode.png">
        <div class="dig1"><?=rand(0,9)?></div>
        <div class="dig6-1"><?=sprintf('%06d',rand(0,999999))?></div>
        <div class="dig6-2"><?=sprintf('%06d',rand(0,999999))?></div>
      </div>
      <div class="centered coupon-desc"><?=$display["couponDesc"]?></div>
      <div class="centered">Show this coupon to your cashier at checkout.</div>
    <?
  }

  function DisplayMembership(){
    ?>
    <h3>Upgrade Your Membership</h3>
    <div>Upgrade your membership to receive the following benefits:
      <ul>
        <li>Get directions to the location you choose</li>
        <li>Special In-Store coupons from select retailers</li>
        <li>And more to come!</li>
      </ul>
      <p>Upgrade to a VIP membership today for only $10!</p>
    </div>
    <div class="centered">
      <button id="upgrade" class="btn btn-primary" onclick="showForm('upgrade-user');">Upgrade Now</button>
    </div>
    <?
  }

  function UpgradeUserForm(){
    ?>
    <div class="upgrade-user">
      <div class="background-mask">
        <form id="upgrade-user" action="./includes/userupgrade.php" method="post">
          <div class="form-group row">
            <div class="col-md-6">
              <label for="Fname">First Name:</label>
              <input class="form-control" type="text" name="Fname" id="Fname" maxLength="24" required />
            </div>
            <div class="col-md-6">
              <label for="Lname">Last Name:</label>
              <input class="form-control" type="text" name="Lname" id="Lname" maxLength="24" required />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="address">Street Address:</label>
              <input class="form-control" type="text" name="address" id="address" required />
            </div>
            <div class="col-md-4">
              <label for="city">City:</label>
              <input class="form-control" type="text" name="city" id="city" required />
            </div>
            <div class="col-md-2">
              <label for="state">State:</label>
              <select class="form-control" id="state" name="state" required>
                <option value="">Select a State</option>
                <? 
                  require_once "backend/DataSource.php";
                  $ds = new DataSource();
                  $query = "SELECT * FROM state";
                  $paramType = "";
                  $paramArray = [];
                  $stmt = $ds->select($query, $paramType, $paramArray);
                  $states = $stmt;
                  foreach ( $states as $key => $state ){
                    ?>
                      <option value="<?=$state["code"]?>"><?=$state["name"]?></option>
                    <?
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-4">
              <label for="card-number">Card Number:</label>
              <input class="form-control" type="text" name="card-number" id="card-number" minLength="13" maxLength="16" placeholder="XXXXXXXXXXXXXXXX" required />
              <div id="cc-not-valid" class="alert alert-danger">Please enter a valid credit card number. Card numbers should not contain any hyphens or spaces.</div>
            </div>
            <div class="col-md-4">
              <label for="exp">Expiration Date:</label>
              <input class="form-control" type="text" name="exp" id="exp" maxLength="7" placeholder="MM/YYYY" required />
              <div id="exp-not-valid" class="alert alert-danger">
                Please enter a valid expiration date. <span class="malformed-exp">Please enter in the form of "MM/YYYY".</span>
              </div>
            </div>
            <div class="col-md-4">
              <label for="cvv">CVV</label>
              <input class="form-control" type="text" name="cvv" id="cvv" maxLength="3" placeholder="###" required />
              <div id="cvv-not-valid" class="alert alert-danger">
                Please enter a valid expiration date.
              </div>
            </div>
          </div>
          <div class="centered">
            <button class="btn btn-primary" type="submit" value="upgrade" name="upgrade">Upgrade Me Now!</button>
            <div  class="btn btn-secondary" onclick="closeForm('upgrade-user')">Cancel</div>
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
            <label for="address">Street Address:</label>
            <input class="form-control" type="text" name="address" id="address" />
          </div>
          <div class="form-group">
            <label for="city">City:</label>
            <input class="form-control" type="text" name="city" id="city" />
            <label for="state">State:</label>
            <select class="form-control" id="state" name="state">
              <option value="">Select a State</option>
              <? 
                require_once "backend/DataSource.php";
                $ds = new DataSource();
                $query = "SELECT * FROM state";
                $paramType = "";
                $paramArray = [];
                $stmt = $ds->select($query, $paramType, $paramArray);
                $states = $stmt;
                foreach ( $states as $key => $state ){
                  ?>
                    <option value="<?=$state["code"]?>"><?=$state["name"]?></option>
                  <?
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="birthday">Date of birth</label>
            <input class="form-control" type="date" name="dob" id="db">
          </div>
          <button class="btn btn-primary" type="submit" value="update" name="update">Update Profile</button>
          <div  class="btn btn-secondary" onclick="closeForm('update-user')">Cancel</div>
        </form>
      </div>
    </div>
    <?
  }

  $account = new Page();

  $account->content ="";

  $account -> Display(6);
  DisplayAccountInfo();
  UpdateUserForm();
  UpgradeUserForm();
}