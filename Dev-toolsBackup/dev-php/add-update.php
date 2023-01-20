<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}
include_once '../../Import/php/database.php';

if($_GET["tg_go"] == 'Add'){
	$exist_query = "SELECT tg_id FROM themengebiete WHERE tg_name = '" . $_GET["tg_name"] . "';";
	if (mysqli_num_rows(mysqli_query($conn, $exist_query)) == 0){
		$add_query = "INSERT INTO `themengebiete` (`tg_id`, `tg_name`, `tg_introduction`, `link_blue`, `rechner`) VALUES (NULL, '".$_GET["tg_name"]."', '".$_GET["tg_intro"]."', '".$_GET["tg_lb"]."', '".$_GET["tg_rechner"]."');";
		
		mysqli_query($conn, $add_query);
	}
}

if($_GET["tg_go"] == 'Update'){
	$exist_query = "SELECT tg_id FROM themengebiete WHERE tg_id = '" . $_GET["tg_id"] . "';";
	echo $exist_query;
	if (mysqli_num_rows(mysqli_query($conn, $exist_query)) > 0){
		if ($_GET["tg_name"] != ""  && $_GET["tg_intro"] != ""  && $_GET["tg_lb"] != ""  && $_GET["tg_rechner"] != ""){
			$update_query = "UPDATE `themengebiete` SET `tg_name` = '".$_GET["tg_name"]."', `tg_introduction` = '".$_GET["tg_intro"]."', `link_blue` = '".$_GET["tg_lb"]."' , `rechner` = '".$_GET["tg_rechner"]."' WHERE `themengebiete`.`tg_id` = " . $_GET["tg_id"] . "; ";
			echo $update_query;
			mysqli_query($conn, $update_query);
		}
	}
}

if($_GET["tg_go"] == 'Add_sub'){
	$exist_query = "SELECT sub_id FROM subgebiete WHERE sub_name = '" . $_GET["sub_name"] . "';";
	if (mysqli_num_rows(mysqli_query($conn, $exist_query)) == 0 && $_GET["sub_name"] != "" && $_GET["sub_tg"] != ""){
		$add_query = "INSERT INTO `subgebiete` (`sub_id`, `sub_name`, `tg_name`) VALUES (NULL, '".$_GET["sub_name"]."', '".$_GET["sub_tg"]."');";
		
		mysqli_query($conn, $add_query);
	}
}

if($_GET["tg_go"] == 'Update_sub'){
	$exist_query = "SELECT sub_id FROM subgebiete WHERE sub_id = '" . $_GET["sub_id"] . "';";
	if (mysqli_num_rows(mysqli_query($conn, $exist_query)) > 0){
		if ($_GET["sub_name"] != ""  && $_GET["sub_tg"] != ""){
			$update_query = "UPDATE `subgebiete` SET `sub_name` = '".$_GET["sub_name"]."', `tg_name` = '".$_GET["sub_tg"]."' WHERE `subgebiete`.`sub_id` = " . $_GET["sub_id"] . "; ";
			mysqli_query($conn, $update_query);
		}
	}
}


header("Location: ../add-remove-update");
