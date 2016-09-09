<?php

/**
 * ProductController.php
 *
 * controller for product page
 */

//including models
include_once "../models/ProductsModel.php";
include_once "../models/CategoriesModel.php";

function indexAction($smarty){
    $itemId = isset($_GET["id"]) ? $_GET["id"] : null;
    if ($itemId == null) exit();

    //get product data
    $rsProduct = getProductById($itemId);

    //get all categories
    $rsCategories = getAllMainCatsWithChildren();

    $smarty->assign("itemInCart", 0);
    if(in_array($itemId, $_SESSION["cart"])){
        $smarty->assign("itemInCart", 1);
    }

    $smarty->assign("pageTitle", "");
    $smarty->assign("rsCategories", $rsCategories);
    $smarty->assign("rsProduct", $rsProduct);

    loadTemplate($smarty, "header");
    loadTemplate($smarty, "product");
    loadTemplate($smarty, "footer");
}
