<?php 
	$für = "Rechner";
	$GetVar = "";
	if (isset($_GET['Artikel'])){
		$rechnerResult = QuerySQL("SELECT rechner_name FROM rechner WHERE article_name = ?", [$_GET['Artikel']], "s");
		$für = "Rechner für " . $_GET['Artikel'];
	} elseif (isset($_GET['s'])) {
		$sql = "SELECT rechner_name FROM rechner WHERE rechner_name LIKE '%" . mysqli_real_escape_string($conn, $_GET['s']) . "%';";
		$rechnerResult = QuerySQL($sql);
		if ($GetVar !== ""){
			$für = 'Suchergebnisse für "' . $_GET['s'] . '"';
		}
	} else{
		$rechnerResult = QuerySQL("SELECT rechner_name FROM rechner");
	}

	//construct html elements
	$inserthtml = ['
		<div class="Linkbox">
			<h2><div>', '</div></h2>
			<div class="stylelinie"></div>
			<div class="Linkflex" id = "spanmax">',

			'<div><span class="link_first"><a href="../Rechner/?',
			'</a></span></div>',

			'</div>
		</div>
	'];

	$echo_html = "";
	$suchergebnisse = false;

	$echo_html .= $inserthtml[0] . $für . $inserthtml[1];
	while ($rechner = mysqli_fetch_assoc($rechnerResult)) {
		$echo_html .= $inserthtml[2] . $rechner['rechner_name'] . '">' . $rechner['rechner_name'] . $inserthtml[3];
		$suchergebnisse = true;
	}
	$echo_html .= $inserthtml[4];

	$echo_html .= '<div class="google-search">Du hast nicht gefunden, was du suchst? Probiers doch mal <a  target="_blank" href="https://www.google.de/search?q=' . $GetVar . '+site%3AAbicheck.de";>hier!</a></div>';

	$conn->close();
?>