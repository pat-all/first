<?php

session_start();
if (! isset($_SESSION["cart"])){
    $_SESSION["cart"] = array();
}
//test commit
//configurations
include_once "../config/config.php";

//data base initialization
include_once "../config/db.php";


//main functions
include_once "../library/mainFunctions.php";


//getting controller
$controllerName = isset($_GET["controller"]) ? ucfirst($_GET["controller"]) : "Index";

//getting function
$actionName = isset($_GET["action"]) ? $_GET["action"] : "index";

//initiating of count of elements in the cart for Smarty
$smarty->assign("cartCntItems", count($_SESSION["cart"]));

loadPage($smarty, $controllerName, $actionName);
