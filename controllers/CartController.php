<?php

/**
 * CartController.php
 *
 * controller for cart
 */

//including models
include_once "../models/CategoriesModel.php";
include_once "../models/ProductsModel.php";

function addToCartAction($itemId){
    $itemId = isset($_GET["id"]) ? intval($_GET["id"]) : null;
    if (! $itemId) return false;

    $resData = array();

    if(isset($_SESSION["cart"]) && array_search($itemId, $_SESSION["cart"]) === false){
        $_SESSION["cart"][] = $itemId;
        $resData["cntItems"] = count($_SESSION["cart"]);
        $resData["success"] = 1;
    } else {
        $resData["success"] = 0;
    }

    echo json_encode($resData);
}