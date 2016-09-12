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
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $email = trim($email);

    $pwd1 = isset($_POST["pwd1"]) ? $_POST["pwd1"] : null;
    $pwd2 = isset($_POST["pwd2"]) ? $_POST["pwd2"] : null;

    $phone   = isset($_POST["phone"]) ? $_POST["phone"] : null;
    $address = isset($_POST["address"]) ? $_POST["address"] : null;
    $name    = isset($_POST["name"]) ? $_POST["name"] : null;
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
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $email = trim($email);

    $pwd = isset($_POST["pwd"]) ? $_POST["pwd"] : null;
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

/**
 * User's page
 *
 * @link /user/
 * @param $smarty
 */
function indexAction($smarty){

    //check for authorized user
    if (! isset($_SESSION["user"])){
        redirect();
    }

    //get categories for menu
    $rsCategories = getAllMainCatsWithChildren();

    $smarty->assign("pageTitle", "User page");
    $smarty->assign("rsCategories", $rsCategories);

    loadTemplate($smarty, "header");
    loadTemplate($smarty, "user");
    loadTemplate($smarty, "footer");
}

function updateAction(){
    //> if user is not login redirect to home page
    if (! isset($_SESSION["user"])){
        redirect();
    }
    //<

    //> initiating variables for sql query
    $resData = array();
    $phone   = isset($_POST["phone"])   ? $_POST["phone"]   : null;
    $address = isset($_POST["address"]) ? $_POST["address"] : null;
    $name    = isset($_POST["name"])    ? $_POST["name"]    : null;
    $pwd1    = isset($_POST["pwd1"])    ? $_POST["pwd1"]    : null;
    $pwd2    = isset($_POST["pwd2"])    ? $_POST["pwd2"]    : null;
    $curPwd  = isset($_POST["curPwd"])  ? $_POST["curPwd"]  : null;
    //<

    // check current password
    $curPwdMD5 = md5($curPwd);
    if(! $curPwd || ($_SESSION["user"]["pwd"] !== $curPwdMD5)){
        $resData["success"] = 0;
        $resData["message"] = "Invalid password";
        echo json_encode($resData);
        return false;
    }

    $res = updateUserData($name, $phone, $address, $pwd1, $pwd2, $curPwdMD5);

    if ($res){
        $resData["success"] = 1;
        $resData["message"] = "Changes were saved";
        $resData["userName"] = $name;

        $_SESSION["user"]["name"]        = $name;
        $_SESSION["user"]["phone"]       = $phone;
        $_SESSION["user"]["address"]     = $address;
        $newPwd = $_SESSION["user"]["pwd"];
        if($pwd1 && ($pwd1 === $pwd2)) {
            $newPwd = md5(trim($pwd1));
        }
        $_SESSION["user"]["pwd"]         = $newPwd;
        $_SESSION["user"]["displayName"] = $name ? $name : $_SESSION["user"]["email"];
    } else {
        $resData["success"] = 0;
        $resData["message"] = "Error in saving data";
    }

    echo json_encode($resData);
}