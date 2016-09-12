<?php
/**
 * Model for Users table
 */

/**
 * User data
 * @param $email - Email
 * @param $pwdMD5 - Password encoded in MD5
 * @param $name - Name
 * @param $phone - Phone
 * @param $address - Address
 */
function registerNewUser($email, $pwdMD5, $name, $phone, $address){

    //cleaning data
    $email   = htmlspecialchars(mysql_real_escape_string($email));
    $pwdMD5  = htmlspecialchars(mysql_real_escape_string($pwdMD5));
    $name    = htmlspecialchars(mysql_real_escape_string($name));
    $phone   = htmlspecialchars(mysql_real_escape_string($phone));
    $address = htmlspecialchars(mysql_real_escape_string($address));

    $sql = "INSERT INTO
            users (`email`, `pwd`, `name`, `phone`, `address`)
            VALUES ('{$email}', '{$pwdMD5}', '{$name}', '{$phone}', '{$address}')";

    $rs = mysql_query($sql);

    if ($rs){
        $sql = "SELECT *
                FROM users
                WHERE (`email` = '{$email}' AND `pwd` = '{$pwdMD5}')
                LIMIT 1";

        $rs = mysql_query($sql);
        $rs = createSmartyRsArray($rs);

        if (isset($rs[0])){
            $rs["success"] = 1;
        } else {
            $rs["success"] = 0;
        }
    } else{
        $rs["success"] = 0;
    }

    return $rs;
}

/**
 * Function checks user's register params
 *
 * @param $email - Email
 * @param $pwd1 - Password
 * @param $pwd2 - Confirm password
 * @return associative array with data
 */
function checkRegisterParams($email, $pwd1, $pwd2){

    $res = null;

    if (! $email){
        $res["success"] = false;
        $res["message"] = "Enter email";
    }

    if (! $pwd1){
        $res["success"] = false;
        $res["message"] = "Enter password";
    }

    if (! $pwd2){
        $res["success"] = false;
        $res["message"] = "Confirm password";
    }

    if ($pwd1 != $pwd2){
        $res["success"] = false;
        $res["message"] = "Passwords does not match";
    }

    return $res;
}

/**
 * Check for existing current email in database (users table)
 *
 * @param $email
 * @return array - row from users table OR empty array
 */
function checkUserEmail($email) {

    $email = mysql_real_escape_string($email);
    $sql = "SELECT id
            FROM users
            WHERE email = '{$email}'";

    $rs = mysql_query($sql);
    $rs = createSmartyRsArray($rs);

    return $rs;
}

/**
 * login user
 *
 * @param string $email - user email
 * @param string $pwd - user password
 *
 * @return array user data
 */
function loginUser($email, $pwd) {
    $email = htmlspecialchars(mysql_real_escape_string($email));
    $pwd   = md5($pwd);

    $sql = "SELECT *
            FROM users
            WHERE (`email` = '{$email}')
            AND `pwd` = '{$pwd}'
            LIMIT 1";

    $rs = mysql_query($sql);

    $rs = createSmartyRsArray($rs);
    if (isset($rs[0])){
        $rs["success"] = 1;
    } else {
        $rs["success"] = 0;
    }

    return $rs;
}