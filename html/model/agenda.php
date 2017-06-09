<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 7-6-2017
 * Time: 14:57
 */
$result_list = array();
//add model for articles
$sql = "SELECT * FROM ".$GLOBALS['table_prefix']."agenda";
$result = $mysqli->query($sql);
while($item = $result->fetch_assoc()) {
    $mysql_date_string = $item['end_d']." ".$item['end_t'];
    $my_date = new DateTime($mysql_date_string);

    if($my_date->format('Y-m-d') >= date('Y-m-d')) {
        $result_list[] = $item;
    }
}