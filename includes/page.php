<?
namespace Foolery;
use \Foolery\Datasource;

class Page {
  public $title;

  function __construct()
  {
      require_once "backend/DataSource.php";
      $this->ds = new DataSource();
  }

  public function __set($name, $value)
  {
    $this -> $name = $value;
  }

  public function Display($pageID)
  {
    $this -> DisplayHead(); // includes all meta information including site title and page names
    $this -> DisplayBody();
    $this -> DisplayHeader(); //includes display menu
    $this -> SetPageInfo($pageID);
    echo $this->content;
    $this -> DisplayFooter();
  }

  public function DisplayHead()
  {
    ?>
      <!DOCTYPE html>
        <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
        <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
        <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
        <!--[if gt IE 8]><!--> <html> <!--<![endif]-->
    <?
      echo "<head>";
      $this -> DisplayMeta();
      $this -> DisplayTitle();
      $this -> DisplayStyles();
      $this -> DisplayScripts();
      echo "</head>";
  }
  
  public function DisplayMeta()
  {
    ?>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <?
  }

  private function DisplayTitle()
  {
    echo "<title>".$this->title."</title>";
  }

  private function DisplayStyles()
  {
    ?>
      <!-- import bootstrap CSS library -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <!-- import font-awesome styles -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />        
      <!-- import local styles-->
      <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <?
  }

  private function DisplayScripts()
  {
    ?>
     <!--import popper js library -->
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <!-- import jquery library -->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
      <!-- import bootstrap js library -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <!-- import site scripts -->
    <?
  }

  public function DisplayBody()
  {
    ?>
      <body>
        <!--[if lt IE 7]>
          <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <?
  }

  public function DisplayHeader()
  {
    $query = "SELECT * FROM sitemap WHERE isNavItem = ?";
    $paramType = "i";
    $paramArray = array(1);
    $stmt = $this->ds->select($query, $paramType, $paramArray);
    $nav_rs= $stmt;
    ?>
    
    <header>
      <!-- mobile menu -->
      <nav class="navbar navbar-expand-lg navbard-light bg-light">
        <a class="navbar-brand" href="index.php">Project FOOLERY</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <?
              foreach ( $nav_rs as $key => $nav ){
                $this->DisplayButton($nav_rs[$key]['pageName'], $nav_rs[$key]['pageID'], $nav_rs[$key]['url']);
              }
            ?>
          </ul>
        </div>
      </nav> 
      <h1><? echo $this->title; ?></h1>
    </header>
    <?
  }

  private function DisplayButton($name, $pageID, $url)
  {
    if (empty($_SESSION['LoggedIn']))
    {
      $loggedIn=false;
    }
    else 
    {
      $loggedIn = $_SESSION['LoggedIn'];
    }

    if ( $pageID == 1 || $pageID == 2 || $pageID == 3 )
    {
      ?>
      <li class="nav-item">
        <a class="nav-link" href="./<?=$url?>.php" title="<?=$name ?>"><?=$name?></a>
      </li>
    <?
    }

    if ($pageID == 4)
    {
      if ($loggedIn){
        return;
      }
      else
      {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="./<?=$url?>.php" title="<?=$name ?>"><?=$name?></a>
        </li>
      <?
      }
    }

    if ( $pageID == 5)
    {
      return;
    }

    if ( $pageID == 6 )
    {
      if ($loggedIn)
      {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="./<?=$url?>.php" title="<?=$name ?>"><?=$name?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./logout.php" title="Log Out">Log Out</a>
          </li>
        <?
      }
      else{return;}
    }
  }

  public function SetPageInfo($pageID)
  {
    $query = "SELECT pageTitle, bgImg, bgImgAlt FROM sitemap where pageID = ?";
    $paramType = "i";
    $paramArray = [$pageID];
    $stmt = $this->ds->select($query, $paramType, $paramArray);

  

    $PageTitle = $stmt[0]['pageTitle'];
    $BGImg = $stmt[0]['bgImg'];
    $BGImgAlt = $stmt[0]['bgImgAlt'];
    ?>      
      <section class='page-title index'>
      <?if (isset($_SESSION["user"])){?>
        <h2><?=$PageTitle." ".$_SESSION["user"]?></h2>
      <?}else{?>
      <h2><?=$PageTitle?></h2>
    <?}?>
      </section>

      <div class="content-panel">
        <div class="panel-img">
          <!-- just pic for reference  -->
          <img src="images/<?=$BGImg?>" alt="<?=$BGImgAlt?>" />
        </div>
      </div>
      <?
  }

  public function DisplayFooter()
  {
    if (isset($credits)){
      echo "<footer>";
      echo $credits;
      echo "</footer>";
    }
    ?>
      <script src="scripts/validate.js" async defer></script>
      <script src="scripts/display.js" async defer></script>
      </body>
    </html>
  <?
  }
}