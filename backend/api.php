<?
namespace Foolery;
session_start();

if (isset($_POST['product'])){
  GetProduct();
}

function GetProduct(){
  $endpoint = 'https://api.upcitemdb.com/prod/trial/search';

  $product = filter_var($_POST['product'], FILTER_SANITIZE_STRING);

  $ch = curl_init();

  //Set cURL options
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

  // HTTP GET
  curl_setopt($ch, CURLOPT_POST, 0);
  curl_setopt($ch, CURLOPT_URL, $endpoint.'?s='.$product);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $errorReason = curl_getinfo($ch, CURLINFO_HTTP)
  if ($httpcode != 200) {
    echo "Error status $httpcode...\n The hamsters fell off the wheel and this is what's wrong with free APIs...";
  }
  else{
    $jsonObj = json_decode($response, true);

    $_SESSION['search_results'] = $jsonObj['items'];
    
    //header("Location: ../index.php?s=$product");
  
  /* if you need to run more queries, do them in the same connection.
  * use rawurlencode() instead of URLEncode(), if you set search string
  * as url query param
  * for search requests, change to sleep(6)
  */
  sleep(6);
  // proceed with other queries
  curl_close($ch);
  }
}