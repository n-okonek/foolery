<?
namespace Foolery;
use \Foolery\Page;

require_once 'includes/page.php';

function LoadContent(){
  ?>
  <form id="product-finder" method="post" action="backend/api.php" class="form-inline product-search">
    <div class="form-group">
      <label class="sr-only" for="product">Search</label>
      <input type="text" class="form-control" id="product" name="product" placeholder="What are you looking for?" />
    </div>
    <button id="search" type="submit" class="btn btn-primary">Find it now!</button>
  </form>
  <?
}

$homepage = new Page();
$homepage->content = "";
$homepage->Display(1);
LoadContent();