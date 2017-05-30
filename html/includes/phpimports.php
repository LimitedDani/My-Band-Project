<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 29-5-2017
 * Time: 09:39
 */
ob_start();
session_start();
$loggedin = false;
if (isset($_SESSION['user'])) {
    $loggedin = true;
}
require 'connectdb.php';
require 'includes/config.php';
require 'libs/Smarty.class.php';

//set up template engine
$templateParser = new Smarty();
$templateParser->template_dir = "views";
$templateParser->compile_dir = "views/compiled";