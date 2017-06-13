<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 29-5-2017
 * Time: 09:56
 */
$pageid = isset($_REQUEST['p']) && !empty($_REQUEST['p']) ? $_REQUEST['p'] : 0;
$pagefeed = $pageid*5;
$result_list = array();
//add model for articles
$sql = "SELECT * FROM ".$GLOBALS['table_prefix']."posts ORDER BY ID DESC LIMIT $pagefeed, 5";
$result = $mysqli->query($sql);
while($item = $result->fetch_assoc()) {
    $result_list[] = $item;
}
$sql="SELECT * FROM ".$GLOBALS['table_prefix']."posts";
$result = mysqli_query($mysqli, $sql);
$count = mysqli_num_rows($result);
$pageisnext = ($pageid+1)*5;
$isnext = false;
if($count > $pageisnext) {
    $isnext = true;
}