<?php
$request = preg_replace("|/*(.+?)/*$|", "\\1", $_SERVER['PATH_INFO']);
$uri = explode('/', $request); 

$uri0 = isset($uri[0]);
$uri1 = isset($uri[1]); 

require_once "config/Database.php";
require_once "model/BuyerOrder.php";
require_once "controller/BuyerOrderController.php";


$db = new Database();
$model = new BuyerOrder($db);
$controller = new BuyerOrderController($model);

//$controller->create();

if ($uri0 && $uri1 && $uri[0] === 'order' && $uri[1] === 'create') {   
    // Create 
    $controller->create();
} elseif ($uri0 && $uri1 && $uri[0] === 'order' && $uri[1] === 'list'){
    $controller->index();
}else {                                                                       // 404
    header('HTTP/1.1 404 Not Found');
echo '<html><body><h1>404</h1><br><br><h2><center>Page Not Found !!!</center></h2></body></html>';
}
// echo 'ok';
//error handler function
function customError($errno, $errstr) {
    echo "<b>Error:</b> [$errno] $errstr";
  }
  
  //set error handler
  set_error_handler("customError");
  
  //trigger error