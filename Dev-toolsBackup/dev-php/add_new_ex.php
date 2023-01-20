<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}

$sub_query = 'SELECT sub_name FROM articles WHERE article_name = "'. $_GET['article_name'] .'"';
$sub_result = mysqli_query($conn, $sub_query);

$sub_name = mysqli_fetch_assoc($sub_result)['sub_name'];


$add_ex_query = "INSERT INTO `exercises` (`ex_id`, `article_name`, `sub_name`, `ex_aufgabe`, `ex_sol`, `ex_reihenfolge`) VALUES (NULL, '" . $_GET['article_name'] . "', '" . $sub_name . "', '', '', '10');";
mysqli_query($conn, $add_ex_query);

$id_query = "SELECT MAX(ex_id) AS 'ex_id' FROM exercises WHERE article_name = '" . $_GET['article_name'] . "'";

$result_id = mysqli_query($conn, $id_query);
$id = mysqli_fetch_assoc($result_id)['ex_id'];


header("Location: ../Dev-tools/articles.php?update_aufgabe=Update+Aufgabe&what=exercises&article_name=" . $_GET['article_name'] . "&update_ex_rf=" . "NEW" . "&update_ex_id=" . $id . "&search=Search");
    exit; 