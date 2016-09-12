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
        return $res;
    }

    if (! $pwd1){
        $res["success"] = false;
        $res["message"] = "Enter password";
        return $res;
    }

    if (! $pwd2){
        $res["success"] = false;
        $res["message"] = "Confirm password";
        return $res;
    }

    if ($pwd1 != $pwd2){
        $res["success"] = false;
        $res["message"] = "Passwords does not match";
        return $res;
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

/**
 * Update User data
 *
 * @param $name - User name
 * @param $phone - User phone
 * @param $address - User address
 * @param $pwd1 - User new password
 * @param $pwd2 - Confirm new password
 * @param $curPwd - User current password
 * @return resource - TRUE if successful
 */
function updateUserData($name, $phone, $address, $pwd1, $pwd2, $curPwd){

    $email   = htmlspecialchars(mysql_real_escape_string($_SESSION["user"]["email"]));
    $name    = htmlspecialchars(mysql_real_escape_string($name));
    $phone   = htmlspecialchars(mysql_real_escape_string($phone));
    $address = htmlspecialchars(mysql_real_escape_string($address));
    $pwd1    = trim($pwd1);
    $pwd2    = trim($pwd2);

    $newPwd = null;
    if($pwd1 && ($pwd1 === $pwd2)) {
        $newPwd = md5($pwd1);
    }

    $sql = "UPDATE users
            SET ";

    if ($newPwd){
        $sql .= "`pwd` = '{$newPwd}',";
    }

    $sql .= " `name` = '{$name}',
              `phone` = '{$phone}',
              `address` = '{$address}'
             WHERE 
              `email` = '{$email}' AND `pwd` = '{$curPwd}'
             LIMIT 1";

    $rs = mysql_query($sql);

    return $rs;
}