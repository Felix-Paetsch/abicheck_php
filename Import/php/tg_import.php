<?php
	include_once '../Import/php/database.php';

	$q = urldecode($_SERVER['REQUEST_URI']);

	
	preg_match('~Abicheck5/(.*?)/~', $q, $gebietarray);
	$gebiet = $gebietarray[1];
	//Wenn es kein Fragezeichen in $q gibt

	if(strpos($q, '?') === false){
		include_once '../Import/php/tg_template2.php';
	} else {
		$q = substr($q, strpos($q, "?")+1, 150);
		$qdir = substr($q, 0, strpos($q, "/"));
		$qname = substr($q, strpos($q, "/")+1, 100);

		$is_articles = QuerySQL("SELECT article_id FROM articles WHERE sub_name = ? AND article_name = ?", [$qdir, $qname], "ss");
		$isarticle = mysqli_num_rows($is_articles);

		if ($isarticle == 1){
			include_once '../Import/php/artikel_template.php';
		} elseif ($isarticle > 1) {
			$error = 'mehrere_Artikel';
			include_once '../Import/php/error_template.php';
		} elseif ($isarticle == 0){
			//remove 'übungen' if exists
			$qname = substr($qname, 0, strpos($qname, "-Übungen"));

			if (strlen($qname) > 0){
				$is_ex = QuerySQL("SELECT ex_aufgabe, ex_sol FROM exercises WHERE sub_name = ? AND article_name = ? ORDER BY ex_reihenfolge;", [$qdir, $qname], "ss");

				//Have we got smth?
				$isex = mysqli_num_rows($is_ex);

				if($isex > 0){
					include_once '../Import/php/übungen_template.php';
				} else {
					$error = 'keine_Aufgaben';
					include_once '../Import/php/error_template.php';
				}
			} else {
				$error = 'falsche_Eingabe';
				include_once '../Import/php/error_template.php';
			}
		} else {
			$error = 'Something went terribly wrong';
			include_once '../Import/php/error_template.php';
		}
	}
?>



