<?php

/**
 * CartController.php
 *
 * controller for cart
 */

//including models
include_once "../models/CategoriesModel.php";
include_once "../models/ProductsModel.php";

/**
 * add to cart function
 *
 * @return json information about operation [success, count of items in cart]
 */
function addtocartAction(){
    $itemId = isset($_GET["id"]) ? intval($_GET["id"]) : null;
    if (! $itemId) return false;

    $resData = array();

    //if id was not found it SESSION["cart"]- create it
    if(isset($_SESSION["cart"]) && array_search($itemId, $_SESSION["cart"]) === false){
        $_SESSION["cart"][] = $itemId;
        $resData["cntItems"] = count($_SESSION["cart"]);
        $resData["success"] = 1;
    } else {
        $resData["success"] = 0;
    }

    echo json_encode($resData);
};

/**
 * removing product from cart
 *
 * @param integer id - Get param of removed product
 * @return json information about operation [success, count of items in cart]
 */
function removefromcartAction(){
    $itemId = isset($_GET["id"]) ? intval($_GET["id"]) : null;
    if (! $itemId) exit();

    $resData = array();
    $key = array_search($itemId, $_SESSION["cart"]);
    if ($key !== false){
        unset($_SESSION["cart"][$key]);
        $resData["success"] = 1;
        $resData["cntItems"] = count($_SESSION["cart"]);
    } else {
        $resData["success"] = 0;
    }

    echo json_encode($resData);
}

function indexAction($smarty){

    $itemsIds = isset($_SESSION["cart"]) ? $_SESSION["cart"] : array();

    $rsCategories = getAllMainCatsWithChildren();
    $rsProducts = getProductsFromArray($itemsIds);

    $smarty->assign("pageTitle", "Cart");
    $smarty->assign("rsCategories", $rsCategories);
    $smarty->assign("rsProducts", $rsProducts);

    loadTemplate($smarty,"header");
    loadTemplate($smarty,"cart");
    loadTemplate($smarty,"footer");
}