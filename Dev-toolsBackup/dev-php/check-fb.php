<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}
include_once '../../Import/php/database.php';

foreach($_POST as $key => $value) { // Most people refer to $key => $value
   $feedback_id = $key;
}

echo $feedback_id;

//read query subgebiete
$feedback_query = "UPDATE `feedback` SET `fb_checked` = !`fb_checked`, `fb_check_time` = NOW() WHERE `feedback`.`fb_id` = " . $feedback_id . "; ";

//subgebiete
mysqli_query($conn, $feedback_query);


//Back to old page
header("Location: ../view-feedback"); ?>