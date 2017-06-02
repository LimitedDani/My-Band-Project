<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 1-6-2017
 * Time: 12:02
 */
class user {
    static function login($email, $password, $mysqli) {
        if(!empty($email) && !empty($password)) {
            $hash = hash('sha256', $password);

            $sql="SELECT * FROM users WHERE email='$email' AND password='$hash'";
            $result = mysqli_query($mysqli, $sql);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            if($count > 0) {
                session_start();
                ob_start();
                $_SESSION['user'] = $row['ID'];
                $_SESSION['UUID'] = $row['UUID'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    static function getName($UUID, $mysqli) {
        $sql="SELECT name FROM users WHERE UUID='$UUID'";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        return $row['name'];
    }
}