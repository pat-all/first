<?php
/**
 * Model for purchase table
 */

/**
 * adding products to data base with link to order
 *
 * @param $orderId
 * @param $cart
 * @return boolean - success TRUE or FALSE
 */
function setPurchaseForOrder($orderId, $cart){
    $sql = "INSERT INTO purchase
            (order_id, product_id, price, amount)
            VALUES ";

    $values = array();
    //create array for query for each product
    foreach ($cart as $item) {
        $values[] = "('{$orderId}', '{$item['id']}', '{$item['price']}', '{$item['cnt']}')";
    }

    //parse array to string
    $sql .= implode($values, ", ");
    $rs = mysql_query($sql);

    return $rs;
}

function getPurchaseForOrder($orderId) {
    $sql = "SELECT `pe`.*, `ps`.`name`
            FROM purchase AS `pe`
            JOIN  products AS `ps` 
            ON `pe`.product_id = `ps`.id
            WHERE `pe`.order_id = '{$orderId}'";

    $rs = mysql_query($sql);

    return createSmartyRsArray($rs);
}