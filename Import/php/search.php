<?php 
	include_once 'Import/php/database.php';
	$q = isset($_GET['s']) ? $_GET['s'] : "";

	//construct html elements
	$inserthtml = ['
		<div class="Linkbox">
			<h2><div>', '</div></h2>
			<div class="stylelinie"></div>
			<div class="Linkflex" id = "spanmax' , '">',

			'<div><span class="link_first"><a href="',
			'</a></span><span><a href="',
			'</a></span></div>',

			'</div>
		</div>
	'];

	$echo_html = "";
	$i = 0;
	//read query bereiche
	$bereiche_query = "SELECT sub_name, tg_name FROM subgebiete WHERE sub_name LIKE '%" . mysqli_real_escape_string($conn, $q) . "%';";
	//themengebiete
	$bereiche = mysqli_query($conn, $bereiche_query);
	if (mysqli_num_rows($bereiche) > 0){
		$echo_html .= $inserthtml[0] . "Bereiche" . $inserthtml[1] . $i . $inserthtml[2];
		//Daten auslesen
		while ($bereich = mysqli_fetch_assoc($bereiche)) {
			$echo_html .= $inserthtml[3] . $bereich['tg_name'] . "/#" . $bereich['sub_name'] . '">' . $bereich['sub_name'] . $inserthtml[4]
							. $bereich['tg_name'] . '"> | ' . $bereich['tg_name'] . $inserthtml[5];
		}
		$echo_html .= $inserthtml[6];
		$i++;
	}

	//read query Artikel
	$article_query = "SELECT articles.sub_name, subgebiete.tg_name, articles.article_name FROM articles LEFT JOIN subgebiete USING (sub_name) WHERE article_name LIKE '%" . mysqli_real_escape_string($conn, $q) . "%';";
	//themengebiete
	$articles = mysqli_query($conn, $article_query);
	if (mysqli_num_rows($articles) > 0){
		$echo_html .= $inserthtml[0] . "Artikel" . $inserthtml[1] . $i . $inserthtml[2];
		//Daten auslesen
		while ($article = mysqli_fetch_assoc($articles)) {
			$echo_html .= $inserthtml[3] . $article['tg_name'] . "/?" . $article['sub_name'] . '/' . $article['article_name'] . '">' . $article['article_name'] . $inserthtml[4]
							. $article['tg_name'] . "/#" . $article['sub_name'] . '"> | ' . $article['sub_name'] . $inserthtml[5];
		}
		$echo_html .= $inserthtml[6];
		$i++;
	}

	//read query Abschnitte
	$contents_query = "SELECT contents.sub_name, subgebiete.tg_name, contents.article_name, contents.content_name FROM contents LEFT JOIN subgebiete USING (sub_name) WHERE content_name LIKE '%" . mysqli_real_escape_string($conn, $q) . "%';";
	//themengebiete
	$contents = mysqli_query($conn, $contents_query);
	if (mysqli_num_rows($contents) > 0){
		$echo_html .= $inserthtml[0] . "Teilabschnitte" . $inserthtml[1] . $i . $inserthtml[2];
		//Daten auslesen
		while ($content = mysqli_fetch_assoc($contents)) {
			$echo_html .= $inserthtml[3] . $content['tg_name'] . "/?" . $content['sub_name'] . '/' . $content['article_name'] . "#" . $content['content_name'] . '">' . $content['content_name'] 
					. $inserthtml[4] . $content['tg_name'] . "/?" . $content['sub_name'] . '/' . $content['article_name'] . '"> | ' . $content['article_name'] . $inserthtml[5];
		}
		$echo_html .= $inserthtml[6];
		$i++;
	}

	//read query Tests
	$files_query = "SELECT files.sub_name, subgebiete.tg_name, files.article_name FROM files LEFT JOIN subgebiete USING (sub_name) WHERE is_test = '1' AND file_name LIKE '%" . mysqli_real_escape_string($conn, $q) . "%';";
	//themengebiete
	$files = mysqli_query($conn, $files_query);
	if (mysqli_num_rows($files) > 0){
		$echo_html .= $inserthtml[0] . "Tests" . $inserthtml[1] . $i . $inserthtml[2];
		//Daten auslesen
		while ($file = mysqli_fetch_assoc($files)) {
			$echo_html .= $inserthtml[3] . "Tests/" . str_replace(" ", "-" , $file['article_name']) . "-Test.pdf" . '" target="_blank">' . $file['article_name'] . " - Test"
					. $inserthtml[4] . $file['tg_name'] . "/?" . $file['sub_name'] . '/' . $file['article_name'] . '"> | ' . $file['article_name'] . $inserthtml[5];
		}
		$echo_html .= $inserthtml[6];
		$i++;
	}

	$conn->close();
?>