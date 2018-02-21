<?php

// create/read session, absolutely necessar
session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

define("APP_ROOTDIR", $_SERVER['DOCUMENT_ROOT']);

/*
if (!isset($_SESSION['userLoginStatus']) OR !$_SESSION['userLoginStatus'] OR $_SERVER["LOCAL_ADDR"] != $_SERVER["REMOTE_ADDR"]) {
	redirect("/");
}
*/

// load DEBUG file
require_once(APP_ROOTDIR."\\v1\\config\\debug.php");

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}

function cleanInput($input) {
	return htmlspecialchars($input);
}

if (APP_DEBUG) {
	
	echo ("getenv(\"USERNAME\"): ".getenv("USERNAME")."<br />");
	echo ("getenv(\"USERDOMAIN\"): ".getenv("USERDOMAIN")."<br />");
	echo ("get_current_user(): ".get_current_user()."<br />");
	echo ("SERVER[\"AUTH_USER\"]: ".$_SERVER["AUTH_USER"]."<br />");
	echo ("SERVER[\"REMOTE_USER\"]: ".$_SERVER["REMOTE_USER"]."<br />");
	echo ("SERVER[\"REMOTE_ADDR\"]: ".$_SERVER["REMOTE_ADDR"]."<br />");
	echo ("SERVER[\"DOCUMENT_ROOT\"]: ".$_SERVER["DOCUMENT_ROOT"]."<br />");

} 

?>

