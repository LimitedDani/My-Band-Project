<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 1-6-2017
 * Time: 16:42
 */
$redirect = false;
if(isset($_REQUEST['adduser'])) {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $role = $_REQUEST['role'];
    $password = $_REQUEST['password'];
    $repeatpassword = $_REQUEST['repeatpassword'];
    $hash = hash('sha256', $password);
    $hashrepeat = hash('sha256', $repeatpassword);
    if(strcmp($hash, $hashrepeat) != 0) {

    } else {
        user::addUser($name, $email, $hash, $role, $mysqli);
    }
    $redirect = true;
}
if(isset($_REQUEST['removeuser'])) {
    if(strcmp($_SESSION['UUID'], $_REQUEST['removeuser']) != 0) {
        user::removeUser($_REQUEST['removeuser'], $mysqli);
    }
    $redirect = true;
}
if(isset($_REQUEST['removeevent'])) {
    admin::removeEvent($_REQUEST['removeevent'], $mysqli);
    $redirect = true;
}
if(isset($_REQUEST['removepost'])) {
    admin::removePost($_REQUEST['removepost'], $mysqli);
    $redirect = true;
}
if(isset($_REQUEST['addpost'])) {
    $title = $_REQUEST['title'];
    $text = $_REQUEST['text'];
    $sql = "INSERT INTO posts (title, article, user, date) VALUES ('".$title."', '".$text."', '".$_SESSION['UUID']."', CURDATE())";
    $result = mysqli_query($mysqli, $sql);
    $redirect = true;
}
if(isset($_REQUEST['edituser'])) {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $role = $_REQUEST['role'];
    $password = $_REQUEST['password'];
    $repeatpassword = $_REQUEST['repeatpassword'];
    $hash = hash('sha256', $password);
    $hashrepeat = hash('sha256', $repeatpassword);
    if (empty($password) && empty($repeatpassword)) {
        $sql = "UPDATE users SET name='$name', email='$email', role='$role' WHERE ID='$id'";
        $result = mysqli_query($mysqli, $sql);
    } else {
        if (strcmp($hash, $hashrepeat) != 0) {

        } else {
            $sql = "UPDATE users SET name='$name', email='$email', role='$role', password='$hash' WHERE ID='$id'";
            $result = mysqli_query($mysqli, $sql);
        }
    }
    $redirect = true;
}

if(isset($_REQUEST['editevent'])) {
    $id = $_REQUEST['id'];
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $start_date = $_REQUEST['start-date'];
    $start_time = $_REQUEST['start-time'];
    $end_date = $_REQUEST['end-date'];
    $end_time = $_REQUEST['end-time'];

    $sql = "UPDATE agenda SET title='$title', description='$description', start_d='$start_date', start_t='$start_time', end_d='$end_date', end_t='$end_time' WHERE ID='$id'";
    $result = mysqli_query($mysqli, $sql);
    $redirect = true;
}
if(isset($_REQUEST['addevent'])) {
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $start_date = $_REQUEST['start-date'];
    $start_time = $_REQUEST['start-time'];
    $end_date = $_REQUEST['end-date'];
    $end_time = $_REQUEST['end-time'];
    admin::addEvent($title, $description, $start_date, $start_time, $end_date, $end_time, $mysqli);
    $redirect = true;
}
if($redirect) {
    header("Location: admin&p=" . $_REQUEST['p']);
}