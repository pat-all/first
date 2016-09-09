<?php
//

//including models
include_once "../models/CategoriesModel.php";
include_once "../models/ProductsModel.php";


function indexAction($smarty) {

    //record set: Categories
    $rsCategories = getAllMainCatsWithChildren();
    $rsProducts = getLastProducts(16);

    $smarty->assign("pageTittle", "Home Page");
    $smarty->assign("rsCategories", $rsCategories);
    $smarty->assign("rsProducts", $rsProducts);


    loadTemplate($smarty, "header");
    loadTemplate($smarty, "index");
    loadTemplate($smarty, "footer");
}