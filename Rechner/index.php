<?php
	$error = '';

	include_once '../Import/php/database.php';

	$q = $_SERVER['REQUEST_URI'];
	$rechner = urldecode(substr($q, 20));

	if($rechner === "" OR isset($_GET['Artikel']) OR isset($_GET['s'])){
		include_once '../Import/php/rechner_select.php';
	} else {
		$is_rechner = QuerySQL("SELECT * FROM rechner WHERE rechner_name = ? ORDER BY rechner_name ASC", [$rechner], "s");
		$isrechnerNumRows = mysqli_num_rows($is_rechner);

		if ($isrechnerNumRows == 1){
			include_once '../Import/php/rechner_template.php';
		} elseif ($isrechnerNumRows > 1) {
			$error = 'mehrere_Rechner';
			include_once '../Import/php/error_template.php';
		} elseif ($isrechnerNumRows == 0){
			$error = 'keine_Rechner';
			include_once '../Import/php/error_template.php';
		} else {
			$error = 'Something went terribly wrong';
			include_once '../Import/php/error_template.php';
		}
	}
?>