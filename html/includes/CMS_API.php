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
class admin {
    static function users($mysqli) {
        $sql="SELECT ID,name,email FROM users";
        $result = mysqli_query($mysqli, $sql);
        $count = mysqli_num_rows($result);
        $content = '    <section class="hero">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Users
                </h1>
                <div class="block">
                    <a class="button">Add user</a>
                </div>
            </div>
        </div>
    </section>
    <hr>';
        $content .= '
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Options</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Options</th>
            </tr>
          </tfoot>
          <tbody>';
            while($row = mysqli_fetch_assoc($result)) {
                $content .= '
                <tr>
                    <th >'.$row["ID"].'</th >
                    <td >'.$row["name"].'</td >
                    <td >'.$row["email"].'</td >
                    <td >********</td >
                    <td ><div class="block" >
                      <a class="button is-info" >Edit</a >
                      <a class="button is-danger" >Remove</a >
                    </div >
                    </td >
                </tr >';
                }
            $content .= '</tbody>
            </table>
            ';
        return $content;
    }
    static function home($mysqli) {

    }

}