<?php
/**
 * initialization of data base
 */

//data base location
$dbLocation = "127.0.0.1";

//data base name
$dbName = "myshop";

//data base user
$dbUser = "root";

//data base password
$dbPass = "";

//connection to data base
$db = mysql_connect($dbLocation, $dbUser, $dbPass);

if (! $db){
    echo "Failed access to MySQL!";
    exit();
}

//data base charset
mysql_set_charset("utf8");

if (! mysql_select_db($dbName, $db)) {
    echo "Failed connection to data base: $dbName";
    exit();
}