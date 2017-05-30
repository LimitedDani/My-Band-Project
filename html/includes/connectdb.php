<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 29-5-2017
 * Time: 09:39
 */
$host="localhost";
$username="root";
$password="Sierra_123";
$db_name="myband";

$mysqli = mysqli_connect($host, $username, $password) or die(mysqli_connect_error());
mysqli_select_db($mysqli, $db_name) or die(mysqli_connect_error());
?>