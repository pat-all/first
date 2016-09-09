<?php

/**
 * Model for table "products"
 */

/**
 * get last $lim products in data base
 *
 * @param null $lim
 * @return array|bool
 */
function getLastProducts($lim = null){
    $sql ="SELECT *
            FROM products
            ORDER BY id DESC";
    if ($lim){
        $sql .=" LIMIT $lim";
    }

    $rs = mysql_query($sql);

    return createSmartyRsArray($rs);
}

/**
 * get products by category
 *
 * @param $itemId
 * @return array|bool
 */
function getProductsByCat($itemId){

    $itemId = intval($itemId);
    $sql = "SELECT *
            FROM products
            WHERE category_id = '{$itemId}'";

    $rs = mysql_query($sql);

    return createSmartyRsArray($rs);
}

function getProductById ($itemId){

    $itemId = intval($itemId);
    $sql = "SELECT *
            FROM products
            WHERE id = '{$itemId}'";

    $rs = mysql_query($sql);
    return mysql_fetch_assoc($rs);
}