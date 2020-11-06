<?
namespace Foolery;
use Foolery\Page;
use Foolery\DataSource;

require_once "includes/page.php";

function DisplayRegForm(){
  ?>
  <div class="reg-container">
    <form id="regform" action="./includes/newuser.php" method="post">
      <? if (isset($_SESSION["errorMessage"])){ ?>
        <div class="alert alert-warning" role="alert"><?= $_SESSION["errorMessage"];?></div>
      <? unset($_SESSION["errorMessage"]); }?>
      <div class="form-group">
        <label for="Fname">First Name:</label>
        <input class="form-control" type="text" name="Fname" id="Fname" maxLength="24" required>
      </div>
      <div class="form-group">
        <label for="Lname">Last Name:</label>
        <input class="form-control" type="text" name="Lname" id="Lname" maxLength="24" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input class="form-control" type="text" name="email" id="email" maxLength="36" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="password">Choose a Password:</label>
        <input class="form-control" type="password" name="password" id="password" onchange="" required />
      </div>
      <div class="form-group">
        <label for="password2">Confirm Password:</label>
        <input class="form-control" type="password" name="password2" id="password2" onchange="" required />
        <div class="alert" id="passmatch" style="display: none;"></div>
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
        <input class="form-control" type="date" name="dob" id="dob" required>
      </div>
      <div class="form-group">
        <button class="btn btn-primary" id="register" type="submit" name="register" value="register" >Register</button>
      </div>
    </form>
  </div>
<?
}

$register = new Page();

$register->content ="";

$register -> Display(5);
DisplayRegForm();