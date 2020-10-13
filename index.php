<?

require('includes/page.php');

class Homepage extends Page{
  public function Display($pageID){
    $this -> DisplayHead(); // includes all meta information including site title and page names
    $this -> DisplayBody();
    $this -> DisplayHeader(); //includes display menu
    $this -> SetPageInfo($pageID);
    echo $this->content;
    $this -> DisplayFooter();
  }
}

$homepage = new Homepage();
$homepage->content = "";
$homepage->Display(1);