<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 1-6-2017
 * Time: 16:42
 */
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
        admin::addUser($name, $email, $hash, $role, $mysqli);
    }
}
if(isset($_REQUEST['removeuser'])) {
    if(strcmp($_SESSION['UUID'], $_REQUEST['removeuser']) != 0) {
        admin::removeUser($_REQUEST['removeuser'], $mysqli);
    }
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
}
if(isset($_REQUEST['editrole'])) {
    $id = $_REQUEST['id'];
    $permissions = $_REQUEST['permissions'];
    $sql = "UPDATE roles SET role_permissions='$permissions' WHERE role_id='$id'";
    $result = mysqli_query($mysqli, $sql);
}