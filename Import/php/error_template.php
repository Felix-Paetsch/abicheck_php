<?php

header("HTTP/1.0 404 Not Found");

if (isset($conn)){
	$error = isset($error) ? $error : "NA";
	$url = $_SERVER['REQUEST_URI'];
	$sql = "INSERT INTO `error_log` (`error_id`, `error_timestamp`, `error_url`, `error_type`) VALUES (NULL, current_timestamp(), ?, ?)";
	QuerySQL($sql, [$url, $error], "ss");

	writeToError($error, $url);
}

  function writeToError($error, $url){
  	$fp = fopen('../Data/error.txt', 'a');
	fwrite($fp, 
		getdatetime() . "\nURL: " . $url . "\nError: " . $error . "\n \n"
	);
	fclose($fp);
  }
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="icon" href="../Import/bilder/webcon2.png">
		<title>404</title>

	<!-- this specific -->
	<link rel="stylesheet" type="text/css" href="../Import/css/searchpage.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/search.css">
	<style type="text/css">
		.error-message{
			margin: 0px 30px 50px 40px;
		}

		.error-message h4{
			margin: 70px 0px 30px 0px;
			font-size: 55px;
			font-weight: 500;
			text-decoration-line: underline;
		}

		.error-message p{

		}
	</style>
</head>

<body>	
<?php include_once "../Import/php/header.php"; ?>

<div class="left-fixed">
	<div class="left-fixed-list">
		<a class="fixed-head fixed-head-a" href="Grundlagen/../">Startseite</a>
		<div class="fixed-head fixed-head-b">Themengebiete</div>
		<div class="fixed-ul">
			<a href="../Grundlagen/">Grundlagen</a>
			<a href="../Geometrie/">Geometrie</a>
			<a href="../Analysis/">Analysis</a>
			<a href="../Stochastik/">Stochastik</a>
		</div>
	</div>
</div>


<div id="main-wrapper">
	<div class="main-content">
		<div class="error-message">
			<h4>Whoooops!</h4>
			<p>Diese Seite wurde nicht gefunden. Bitte probiere die Suchfunktion.</p>
		</div>
		<div class="big-search">
			<div class="search-area">
				<form class="search" action="../suche">
					<input type="text" placeholder="Was möchtest du lernen?" name="s">
					<button type="submit"></button>
				</form>
			</div>
		</div>
	</div>

	<div class="scroll-up" id="scroll-up" tilte="Nach oben">
		<div class="arrow arrow1"></div>
		<div class="arrow arrow2"></div>
	</div>
</div>
<footer id="footer">
	<div>
		<div>
			<h2>Mathe lernen</h2>
			<ol>
				<li><a href="../Grundlagen/">Grundlagen</a></li>
				<li><a href="../Geometrie/">Geometrie</a></li>
				<li><a href="../Analysis/">Analysis</a></li>
				<li><a href="../Stochastik/">Stochastik</a></li>
			</ol>
		</div>
		<div>
			<h2>Mehr</h2>
			<ol>
				<li><a href="../Prüfungen">Prüfungen</a></li>
				<li><a href="../Rechner/">Rechner</a></li>
			</ol>
		</div>
		<div>
			<h2>Abicheck</h2>
			<ol>
				<li><a href="../about">Über Abicheck</a></li>
				<li>Kontakt</li>
				<li>Impressum</li>
				<li>Datenschutz</li>
			</ol>
		</div>
	</div>
</footer>
<script type="text/javascript" src="../Import/js/scrollup.js"></script>
</body>
</html>



<?php
die();