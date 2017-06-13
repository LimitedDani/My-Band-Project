<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 1-6-2017
 * Time: 10:56
 */
if(isset($_POST['submit'])) {
    require_once "includes/recaptchalib.php";
    $recaptha = $_POST["g-recaptcha-response"];
    $secret = "6Lcmth0UAAAAACYTEh047j-VfHYNaxoF_rMZALlr";
    $reCaptcha = new ReCaptcha($secret);
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $recaptha
    );
    if($response != null && $response->success) {
        $email = $_POST['email'];
        $email = trim($email);
        $email = strip_tags($email);
        $email = mysqli_real_escape_string($mysqli, $email);
        $password = $_POST['password'];
        if (user::login($email, $password, $mysqli)) {
            header("Location: /myband/admin");
        }
        exit;
    }
}
if(isset($_POST['passrequest'])) {

}