<?php

/**
 * CartController.php
 *
 * controller for cart
 */

//including models
include_once "../models/CategoriesModel.php";
include_once "../models/ProductsModel.php";
include_once "../models/OrdersModel.php";
include_once "../models/PurchaseModel.php";

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

/**
 * Creating order
 *
 *
 */
function orderAction($smarty){
    //getting array of products' IDs in the cart
    $itemsIds = isset($_SESSION["cart"]) ? $_SESSION["cart"] : null;
    //if the cart is empty - redirect to cart
    if (! $itemsIds){
        redirect("/cart/");
        return;
    }

    //getting from $_POST array numbers of products
    $itemsCnt = array();
    foreach ($itemsIds as $item){
        // key for POST array
        $postVar = "itemCnt_" . $item;
        /*
         * create array element - count of bough product
         * key for array - product ID, variable - count
         * $itemCnt[1] = 3; product with ID == 1 was bough 3 times
         */
         $itemsCnt[$item] = isset($_POST[$postVar]) ? $_POST[$postVar] : null;
    }

    $rsProducts = getProductsFromArray($itemsIds);
    /*
     * add a new field for each product
     * "realPrice" = count multiply on a price of a product
     * "cnt" - quantity of bough product
     *
     * &$item - for changing element of $rsProducts array
     * when $item is changed
     */
    $i = 0;
    foreach ($rsProducts as &$item){
        $item["cnt"] = isset($itemsCnt[$item["id"]]) ? $itemsCnt[$item["id"]] : 0;
        if($item["cnt"]){
            $item["realPrice"] = $item["cnt"] * $item["price"];
        } else {
            /*
             * if it is a product in the cart with count == 0
             * remove this product
             */
            unset($rsProducts[$i]);
        }
        $i++;
    }

    if(! $rsProducts){
        echo "Cart is empty";
        return;
    }

    //move resulting array to session variable saleCart
    $_SESSION["saleCart"] = $rsProducts;

    $rsCategories = getAllMainCatsWithChildren();

    /*
     * hideLoginBox variable - flag for hiding block for login
     * and registration on a side bar
     */
    if (!isset($_SESSION["user"])){
        $smarty->assign("hideLoginBox", 1);
    }

    $smarty->assign("pageTitle", "Order");
    $smarty->assign("rsCategories", $rsCategories);
    $smarty->assign("rsProducts", $rsProducts);

    loadTemplate($smarty, "header");
    loadTemplate($smarty, "order");
    loadTemplate($smarty, "footer");
}

/**
 * saveorderAction
 *
 * AJAX function for saving order
 *
 * @param array $_SESSION["saleCart"] of purchase products
 * @return json information about result
 */
function saveorderAction(){
    //get array of purchase product
    $cart = isset($_SESSION["saleCart"]) ? $_SESSION["saleCart"] : null;
    //if the variable $_SESSION["saleCart"] is empty, create an error message
    //and return it in json function
    if(! $cart){
        $resData["success"] = 0;
        $resData["message"] = "Error: no products in order";
        echo json_encode($resData);
        return;
    }

    $name    = $_POST["name"];
    $phone   = $_POST["phone"];
    $address = $_POST["address"];

    //create new order and get it's ID
    $orderId = makeNewOrder($name, $phone, $address);

    //if order wasn't created
    if(! $orderId) {
        $resData["success"] = 0;
        $resData["message"] = "Error: order wasn't created";
        echo json_encode($resData);
        return;
    }

    //save products for created order
    $res = setPurchaseForOrder($orderId, $cart);

   if ($res){
       $resData["success"] = 1;
       $resData["message"] = "Order was saved successful";

       unset($_SESSION["saleCart"]);
       unset($_SESSION["cart"]);
   } else {
       $resData["success"] = 0;
       $resData["message"] = "Error: order wasn't saved " . $orderId;
   }

   echo json_encode($resData);
}
