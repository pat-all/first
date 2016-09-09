<?php

/**
 * this model works with table "Categories"
 */

/**
 * @param $catId
 */
function getChildrenForCat($catId){
    $sql = "SELECT *
            FROM categories
            WHERE parent_id = $catId";

    $rs = mysql_query($sql);

    return createSmartyRsArray($rs);
}

/**
 * get all main categories with children
 *
 * @return array
 */
function getAllMainCatsWithChildren () {
    $sql = "SELECT *
            FROM categories
            WHERE parent_id = 0";

    $rs = mysql_query($sql);

    //record set for Smarty
    $smartyRs = array();

    while ($row = mysql_fetch_assoc($rs)){

        //get children for category
        $rsChildren = getChildrenForCat($row["id"]);

        if($rsChildren){
            $row["children"] = $rsChildren;
        }

        $smartyRs[] = $row;
    }

    return $smartyRs;
}

function getCatById($catId){

    $catId = intval($catId);
    $sql = "SELECT *
            FROM categories
            WHERE id= '{$catId}'";

    $rs = mysql_query($sql);

    return mysql_fetch_assoc($rs);
}