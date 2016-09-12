<?php
/**
 *UserController
 */

//including models
include_once "../models/CategoriesModel.php";
//include_once "../models/OrdersModel.php";
include_once "../models/UsersModel.php";

/**
 * AJAX users registration
 * Initiation of session variable ($_SESSION["user"])
 *
 * @return json data array for new user
 */
function registerAction(){
    $email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : null;
    $email = trim($email);

    $pwd1 = isset($_REQUEST["pwd1"]) ? $_REQUEST["pwd1"] : null;
    $pwd2 = isset($_REQUEST["pwd2"]) ? $_REQUEST["pwd2"] : null;

    $phone   = isset($_REQUEST["phone"]) ? $_REQUEST["phone"] : null;
    $address = isset($_REQUEST["address"]) ? $_REQUEST["address"] : null;
    $name    = isset($_REQUEST["name"]) ? $_REQUEST["name"] : null;
    $name    = trim($name);

    $resData = null;
    $resData = checkRegisterParams($email, $pwd1, $pwd2);

    if(! $resData && checkUserEmail($email)){
        $resData["success"] = false;
        $resData["message"] = "User with current email ('{$email}') already exists";
    }

    if (! $resData){
        $pwdMD5 = md5($pwd1);

        $userData = registerNewUser($email, $pwdMD5, $name, $phone, $address);

        if ($userData["success"]){
            $resData["message"] = "User was registered successful";
            $resData["success"] = 1;

            $userData = $userData[0];
            $resData["userName"] = $userData["name"] ? $userData["name"] : $userData["email"];
            $resData["userEmail"] = $userData["email"];

            $_SESSION["user"] = $userData;
            $_SESSION["user"]["displayName"] = $userData["name"] ? $userData["name"] : $userData["email"];
        } else {
            $resData["success"] = 0;
            $resData["message"] = "Registration error";
        }
    }

    echo json_encode($resData);
}

/**
 * user logout
 *
 * remove user and cart from $_SESSION
 * redirect to Home Page
 */
function logoutAction(){
    if (isset($_SESSION["user"])){
        unset($_SESSION["user"]);
        unset($_SESSION["cart"]);
    }

    redirect();
}

/**
 * AJAX user login
 *
 * @return json array of user data
 */
function loginAction(){
    $email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : null;
    $email = trim($email);

    $pwd = isset($_REQUEST["pwd"]) ? $_REQUEST["pwd"] : null;
    $pwd = trim($pwd);

    $userData = loginUser($email, $pwd);

    if ($userData["success"]){
        $userData = $userData[0];

        $_SESSION["user"] = $userData;
        $_SESSION["user"]["displayName"] = $userData["name"] ? $userData["name"] : $userData["email"];

        $resData = $_SESSION["user"];
        $resData["success"] = 1;

//        $resData["userName"]  = $userData["name"] ? $userData["name"] : $userData["email"];
//        $resData["userEmail"] = $userData["email"];
    } else {
        $resData["success"] = 0;
        $resData["message"] = "Invalid login or password";
    }

    echo json_encode($resData);
}