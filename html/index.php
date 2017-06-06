<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 29-5-2017
 * Time: 09:43
 */
require 'includes/phpimports.php';
$action = isset($_GET['page']) ? $_GET['page'] : 'home';
switch ($action) {
    case 'home':
        require_once 'model/head.php';
        require_once 'model/nav.php';
        require_once 'model/home.php';
        $templateParser->assign('result_list', $result_list);
        $templateParser->display('home.tpl');
        break;
    case 'admin':
        if(isset($_SESSION['user'])) {
            if(!permissions::hasPermission(admin::getRoleID($_SESSION['UUID'], $mysqli), permissions::ReachDashboard, $mysqli)) {
                session_unset();
                session_destroy();
                session_write_close();
                header("Location: admin");
                exit;
            }
            require_once 'model/admin.php';
            require_once 'model/head.php';
            $session = array('id' => $_SESSION['user'], 'uuid' => $_SESSION['UUID'], 'name' => user::getName($_SESSION['UUID'], $mysqli));
            $content;
            if(isset($_GET['p'])) {
                if(!empty($_GET['p'])) {
                    switch($_GET['p']) {
                        case 'users':
                            $content = admin::users($mysqli);
                            break;
                        case 'home':
                            $content = admin::home($mysqli);
                            break;
                        case 'addpost':
                            $content = admin::addPost($mysqli);
                            break;
                        default:
                            $content = admin::home($mysqli);
                            break;
                    }
                }
            }
            if(empty($content)) {
                $content = admin::home($mysqli);
            }
            $header = admin::getHeader($_GET['p']);
            $templateParser->assign('session', $session);
            $templateParser->assign('content', $content);
            $templateParser->assign('header', $header);
            $templateParser->display('adminhome.tpl');
            break;
        } else {
            require_once 'model/login.php';
            require_once 'model/head.php';
            $background = array("content/michael-hull-2283.jpg");
            $i = rand(0, count($background) - 1);
            echo '<style>body {
                        background-image: url("' . $background[$i] . '");
                  }</style>';
            $templateParser->display('admin.tpl');
            break;
        }
    case 'logout':
        session_unset();
        session_destroy();
        session_write_close();
        header("Location: admin");
        break;
    default:
        require_once 'model/head.php';
        require_once 'model/nav.php';
        require_once 'model/home.php';
        $templateParser->assign('result_list', $result_list);
        $templateParser->display('home.tpl');
        break;
}
require_once 'model/foot.php';
