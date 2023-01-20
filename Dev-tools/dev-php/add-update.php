<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}
include_once '../../Import/php/database.php';

switch ($_GET["tg_go"]) {
    case 'Add':
        $exist_query = "SELECT tg_id FROM themengebiete WHERE tg_name = ?;";
        $existParam = [$_GET["tg_name"], "s", 0];
        $SqlQuery = "INSERT INTO `themengebiete` (`tg_id`, `tg_name`, `tg_introduction`, `link_blue`, `rechner`) VALUES 
            (NULL, ?, ?, ?, ?);";
        $params = [
            $_GET["tg_name"],
            $_GET["tg_intro"],
            $_GET["tg_lb"],
            $_GET["tg_rechner"]
        ];
        $typeString = "ssss";
        break;
    case 'Update':
        $exist_query = "SELECT tg_id FROM themengebiete WHERE tg_id = ?;";
        $existParam = [$_GET["tg_id"], "i", 1];
        $SqlQuery = "UPDATE `themengebiete` SET `tg_name` = ?, `tg_introduction` = ?, `link_blue` = ?, `rechner` = ? WHERE `themengebiete`.`tg_id` = ?; ";
        $params = [
            $_GET["tg_name"],
            $_GET["tg_intro"],
            $_GET["tg_lb"],
            $_GET["tg_rechner"],
            $_GET["tg_id"]
        ];
        $typeString = "ssssi";
        break;
    case 'Add_sub':
        $exist_query = "SELECT sub_id FROM subgebiete WHERE sub_name = ?;";
        $existParam = [$_GET["sub_name"], "s", 0];
        $SqlQuery = "INSERT INTO `subgebiete` (`sub_id`, `sub_name`, `tg_name`) VALUES (NULL, ?, ?);";
        $params = [
            $_GET["sub_name"],
            $_GET["sub_tg"]
        ];
        $typeString = "ss";
        break;
    case 'Update_sub':
        $exist_query = "SELECT sub_id FROM subgebiete WHERE sub_id = ?;";
        $existParam = [$_GET["sub_id"], "i", 1];
        $SqlQuery = "UPDATE `subgebiete` SET `sub_name` = ?, `tg_name` = ? WHERE `subgebiete`.`sub_id` = ?; ";
        $params = [
            $_GET["sub_name"],
            $_GET["sub_tg"],
            $_GET["sub_id"]
        ];
        $typeString = "ssi";
        break;
    default:
        echo "Something is very wrong 'tg_go' has a crazy value";
        die();
}

if(mysqli_num_rows(QuerySQL($exist_query, [$existParam[0]], $existParam[1])) === $existParam[2]){
    SaveQuerySQL($SqlQuery, $params, $typeString);
} else {echo "wrong param subly (gibts schon/value leer)"; die();}

$conn->close();

header("Location: ../add-remove-update");
