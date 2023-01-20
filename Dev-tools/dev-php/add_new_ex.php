<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}

$sub_result = QuerySQL('SELECT sub_name FROM articles WHERE article_name = ?', [$_GET['article_name']], "s");
$sub_name = mysqli_fetch_assoc($sub_result)['sub_name'];

$add_ex_query = "INSERT INTO `exercises` (`ex_id`, `article_name`, `sub_name`, `ex_aufgabe`, `ex_sol`, `ex_reihenfolge`) VALUES (NULL, ?, ?, '', '', '10');";
SaveQuerySQL($add_ex_query, [$_GET['article_name'], $sub_name], "ss");

$result_id = QuerySQL("SELECT MAX(ex_id) AS 'ex_id' FROM exercises WHERE article_name = ?", [$_GET['article_name']], "s");
$id = mysqli_fetch_assoc($result_id)['ex_id'];
header("Location: articles.php?update_aufgabe=Update+Aufgabe&what=exercises&article_name=" . $_GET['article_name'] . "&update_ex_rf=" . "NEW" . "&update_ex_id=" . $id . "&search=Search");
exit; 