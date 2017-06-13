<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 29-5-2017
 * Time: 09:56
 */
$id = (empty($_REQUEST["id"]) ? $_REQUEST["ID"] : $_REQUEST["id"]);
$title;
$article;
//add model for articles
$sql = "SELECT * FROM ".$GLOBALS['table_prefix']."posts WHERE ID='$id'";
$result = $mysqli->query($sql);
$row = mysqli_fetch_assoc($result);
$title = $row['title'];
$article = $row['article'];

if(isset($_REQUEST['comment_post'])) {
    require_once "includes/recaptchalib.php";
    $recaptha = $_POST["g-recaptcha-response"];
    $secret = "6Lcmth0UAAAAACYTEh047j-VfHYNaxoF_rMZALlr";
    $reCaptcha = new ReCaptcha($secret);
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $recaptha
    );
    if($response != null && $response->success) {
        $name = $_REQUEST['comment_name'];
        $message = $_REQUEST['comment_message'];
        $id = $_REQUEST['comment_id'];
        $sql = "INSERT INTO " . $GLOBALS['table_prefix'] . "comments (user, comment, article) VALUES ('" . $name . "', '" . $message . "', '$id')";
        $result = mysqli_query($mysqli, $sql);
        $redirect = true;
    }
}

$comments = array();
//add model for articles
$sql = "SELECT * FROM ".$GLOBALS['table_prefix']."comments WHERE article='$id'";
$result = $mysqli->query($sql);
while($item = $result->fetch_assoc()) {
    $comments[] = $item;
}
