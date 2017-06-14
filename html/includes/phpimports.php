<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 29-5-2017
 * Time: 09:39
 */
session_name("ja");
ob_start();
session_start();
require 'connectdb.php';
require 'includes/config.php';
require 'libs/Smarty.class.php';
require 'includes/CMS_API.php';
foreach($_REQUEST as $key => $value) {
    $_REQUEST[$key] = your_filter($value, $mysqli);
}
function your_filter($value, $mysqli) {
    $newVal = trim($value);
    $newVal = mysqli_real_escape_string($mysqli, $newVal);
    return $newVal;
}


$loggedin = false;
if (isset($_SESSION['user'])) {
    $loggedin = true;
}
//set up template engine
$templateParser = new Smarty();
$templateParser->template_dir = "views";
$templateParser->compile_dir = "views/compiled";