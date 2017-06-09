<?php
/**
 * Created by PhpStorm.
 * User: daniq
 * Date: 7-6-2017
 * Time: 14:57
 */
$result_list = array();
//add model for articles
$sql = "SELECT * FROM agenda";
$result = $mysqli->query($sql);
while($item = $result->fetch_assoc()) {
    if (new DateTime() < new DateTime($item['end_d']." ".$item['end_t'])) {
        $result_list[] = $item;
    }
}