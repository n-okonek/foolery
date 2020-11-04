<?
namespace Foolery;
use Foolery\Page;

require_once 'includes/page.php';

function LoadContent(){
  ?>
  <form class="form-inline product-search">
    <div class="form-group">
      <label class="sr-only" for="search-product">Search</label>
      <input type="text" class="form-control" id="search-product" placeholder="What are looking for?" />
    </div>
    <button type="submit" class="btn btn-primary">Find it now!</button>
  </form>
  <?
}

$homepage = new Page();
$homepage->content = "";
$homepage->Display(1);
LoadContent();