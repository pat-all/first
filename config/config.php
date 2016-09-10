<?php
//global variables

//>constants for requesting controllers
define("PATH_PREFIX", "../controllers/");
define("PATH_POSTFIX", "Controller.php");
//<

//>Smarty config

//template
$template = "default";

//paths to template's files (*tpl)
define("TemplatePrefix", "../views/{$template}/");
define("TemplatePostfix", ".tpl");

//paths to templates in web
define("TemplateWebPath", "/templates/{$template}/");
//<

//>Smarty initialisation

//put full path to Smarty.class.php
require ("../library/Smarty/libs/Smarty.class.php");
$smarty = new Smarty();

$smarty->setTemplateDir(TemplatePrefix);
$smarty->setCompileDir("../tmp/templates_c");
$smarty->setCacheDir("../tmp/cache");
$smarty->setConfigDir("../library/Smarty/configs");

$smarty->assign("templateWebPath", TemplateWebPath);
//<
