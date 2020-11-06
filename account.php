<?
namespace Foolery;
use Foolery\Page;
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
        </div>
        <button class="btn btn-primary" type="submit" onclick="showForm('update-user');">Update Profile</button>
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
}