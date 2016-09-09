<?php
//all main functions

/**
 * creating requested page
 *
 * @param $controllerName
 * @param string $actionName
 */
function loadPage($smarty, $controllerName, $actionName = "index") {

    include_once PATH_PREFIX . $controllerName . PATH_POSTFIX;

    $function = $actionName . "Action";
    $function($smarty);
}

/**
 * loading template
 *
 * @param $smarty
 * @param $templateName
 */
function loadTemplate ($smarty, $templateName) {
    $smarty->display($templateName . TemplatePostfix);
}

/**
 * debugging
 *
 * @param null $value
 * @param int $die
 */
function d($value = null, $die = 1){
    echo "Debug: <br><pre>";
    print_r($value);
    echo "</pre>";

    if ($die) die;
}

/**
 * parsing result of getting function to array
 *
 * @param $rs - result of data base query
 * @return array|bool
 */
function createSmartyRsArray($rs){
    if (! $rs) return false;

    $smartyRs = array();
    while ($row = mysql_fetch_assoc($rs)){
        $smartyRs[] = $row;
    }
    return $smartyRs;
}