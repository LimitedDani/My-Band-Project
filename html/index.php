<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 29-5-2017
 * Time: 09:43
 */
require 'includes/phpimports.php';
require 'model/head.php';
require 'model/nav.php';
$action = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($action) {
    case 'home':
        require_once 'model/home.php';
        $templateParser->assign('result_list', $result_list);
        $templateParser->display('home.tpl');
        break;
    default:
        require_once 'model/home.php';
        $templateParser->assign('result_list', $result_list);
        $templateParser->display('home.tpl');
        break;
}
