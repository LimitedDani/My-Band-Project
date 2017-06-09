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