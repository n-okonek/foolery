<?
namespace Foolery;
use Foolery\Page;

session_start();
require_once "includes/page.php";

class LoginPage extends Page{
  public function Display($pageID){
    $this -> DisplayHead(); // includes all meta information including site title and page names
    $this -> DisplayBody();
    $this -> DisplayHeader(); //includes display menu
    $this -> SetPageInfo($pageID);
    echo $this->content;
    $this -> DisplayLogin();
    $this -> DisplayPwReset();
    $this -> DisplayNewPw();
    $this -> DisplayFooter();
  }

  private function DisplayLogin(){
    ?>  <!-- discuss log-in processing for php --->
    <div class="login-container">
      <form id='login' action='./includes/auth.php' method='post' onSubmit='return validate();'>
        <?
          if (isset($_SESSION["errorMessage"])){
            ?>
            <div class="alert alert-warning" role="alert"><?= $_SESSION["errorMessage"];?></div>
            <? unset($_SESSION["errorMessage"]);
          }
          if (isset($_SESSION["successMessage"])){
            ?>
            <div class="alert alert-success" role="alert"><?= $_SESSION["successMessage"];?></div>
            <? unset($_SESSION["successMessage"]);
          }
        ?>
          <div class="form-group">
            <label for='userName'><b>Email Address:</b></label><span id='user_info' class='error-info'></span>
            <input class='form-control' type='text' placeholder='Enter Email Address' name='userName' id='userName' required></br>
          </div>
          <div class="form-group">
            <label for='pswd'><b>Password:</b></label><span id='password_info' class='error-info'></span>
            <input class='form-control' type='password' placeholder='Enter Password' name='pswd' id='pswd' required></br>
          </div>
        <div class='form-group'>
          <button class="btn btn-primary" type='submit' name="login" value="Login">Log-in</button>
          <span class='pswd'><a href="#reset" onclick="showForm('pw-reset')">Forget your password?</span> | <span class='createAccount'><a href='./register.php'>Create an account</a></span>
        </div>
      </form>
    </div>
    <?
  }

  private function DisplayPwReset(){
    ?>
      <div class="pw-reset">
        <form id="pw-reset" action="includes/resetreq.php" method="post">
          <h3>Reset your password</h3>
				  <p>An e-mail will be sent to you with instructions on how to reset your password. </p>
          <input type="text" class="form-control" name="email" placeholder="Enter your e-mail address...">
          <br />
          <div class="container" id="submit" >
            <button type="submit" name="reset-request-submit">Receive new password by e-mail</button>
          </div>
          <div class="container" id="cancel">
            <div onclick="closeForm('pw-reset')">Cancel</div>
          </div>
				</form>
      </div>
    <?
  }

  private function DisplayNewPw(){

    if ( isset($_GET['selector']) && isset($_GET['validator'])){

      $selector = $_GET["selector"];
      $validator = $_GET["validator"];
      
      if (empty($selector) || empty($validator)) {
        echo "Could not validate your request!";
      } 
      else {
        //DEBUGGING purposes only
        //$_SESSION['errorMessage'] = "selector xdigit = ".ctype_xdigit($selector)." validator xdigit = ".ctype_xdigit($validator);
        if ( ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false ) {
          ?>
            <div class="new-pw">
              <form id="new-pw" action="includes/resetreq.php" method="post">
                <input type="hidden" name="selector" value="<? echo $selector?>">
                <input type="hidden" name="validator" value="<? echo $validator?>">
                <label for='pwd'><b>Enter new password:</b></label><input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter a new Password.."><br />
                <label for='pwd-repeat'><b>Confirm new password:</b></label><input type="password" class="form-control" name="pwd-repeat" id="pwd-repeat" placeholder="Repeat new Password.."><br />
                <button type="submit" name="reset-password-submit">Reset Password</button>
              </form>
            </div>
          <?
        }
      }
    }
  }
}

$login = new LoginPage();

$login->content = "";

$login->Display(4);
?>
