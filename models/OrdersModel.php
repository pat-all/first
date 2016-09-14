<?php
/**
 * Model for orders model
 */

/**
 * makeNewOrder function
 *
 * @param $name
 * @param $phone
 * @param $address
 * @return integer ID of new order
 */
function makeNewOrder($name, $phone, $address){
    //> initiation of variables for orders table
    $userId  = $_SESSION["user"]["id"];
    //dirty data -  needs to be cleared
    $comment = "user id: {$userId}<br>
                 Name: {$name}<br>
                 Phone: {$phone}<br>
                 Address: {$address}";

    $dateCreated = date("Y.m.d H:i:s");
    $userIp      = $_SERVER["REMOTE_ADDR"];
    //<

    //creating a query to data base
    $sql = "INSERT INTO
            orders (`user_id`, `date_created`, `date_payment`,
                      `status`, `comment`, `user_ip`)
            VALUES ('{$userId}', '{$dateCreated}', null, 
                      '0', '{$comment}', '{$userIp}')";

    $rs = mysql_query($sql);

    //get id of created order, if it was
    if ($rs){
        $sql = "SELECT id
                FROM orders
                ORDER BY id DESC 
                LIMIT 1";

        $rs = mysql_query($sql);
        //transform query result to array
        $rs = createSmartyRsArray($rs);

        //return id of query
        if(isset($rs[0])){
            return $rs[0]["id"];
        }

        return false;
    }
}

/**
 * Get orders' list for user ($userID) chained to products
 *
 * @param $userId - integer user ID
 * @return array - orders chained to products
 */
function getOrdersWithProductsUser($userId){

    $userId = intval($userId);
    $sql = "SELECT * 
            FROM orders
            WHERE `user_id` = '{$userId}'
            ORDER BY id DESC";

    $rs = mysql_query($sql);
    while ($row = mysql_fetch_assoc($rs)){
        $rsChildren = getPurchaseForOrder($row["id"]);

        if($rsChildren){
            $row["children"] = $rsChildren;
            $smartyRs[] = $row;
        }
    }

    return $smartyRs;
}