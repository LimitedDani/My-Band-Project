<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 1-6-2017
 * Time: 10:56
 */
if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = trim($email);
    $email = strip_tags($email);
    $email = mysqli_real_escape_string($mysqli, $email);
    $password = $_POST['password'];
    if(user::login($email, $password, $mysqli)) {
        header("Location: admin");
    }
    exit;
}
if(isset($_POST['passrequest'])) {

}