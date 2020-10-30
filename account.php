<?
namespace Foolery;
use Foolery\Page;
require_once "includes/page.php";

session_start();

if (empty($_SESSION['LoggedIn'])){
  $_SESSION["errorMessage"] = "We were not able to identify your account, please log in.";
  header("Location: ./login.php");
}

else{
  require_once "includes/page.php";

  Class MyAccountPage extends Page{

    public function Display($pageID){
      $this -> DisplayHead(); // includes all meta information including site title and page names
      $this -> DisplayBody();
      $this -> DisplayHeader(); //includes display menu
      $this -> SetPageInfo($pageID);
      echo $this->content;
      $this -> DisplayAccountInfo();
      $this -> DisplayFooter();
      $this -> UpdateUserForm();
    }

    private function DisplayAccountInfo(){
      ?>
        <!-- Account info secion -->
        <div class="account-panel">
          <h3><?php echo "Account Information"?></h3>
          <div class ="accountInfo">
              <p><?php echo "Member name: ".$_SESSION['MemberName'] ?></p>
              <p><?php echo "Member since: ".$_SESSION['MemberSince']  ?></p>
              <p><?php echo "Email: ".$_SESSION['Email'] ?></p>
              <p><?php echo "Birthday: ".$_SESSION['DOB'] ?></p>
          </div>
          <div class="container" id="submit">
              <button type="submit" onclick="showForm('update-user');">Update Profile</button>
          </div>    
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
            <label for="birthday">Date of birth</label>
            <input class="form-control" type="date" name="dob" id="db">
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

  $account = new MyAccountPage();

  $account->content ="";

  $account -> Display(6);
}