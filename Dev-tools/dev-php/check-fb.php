<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}
include_once '../../Import/php/database.php';

foreach($_POST as $key => $value) {
   $feedback_id = $key;
}

QuerySQL("UPDATE `feedback` SET `fb_checked` = !`fb_checked`, `fb_check_time` = NOW() WHERE `feedback`.`fb_id` = ?; ", $params = [$feedback_id], $parameterTypes = "i");

$conn->close();
header("Location: ../view-feedback"); ?>