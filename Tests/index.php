<?php 
	include_once '../Import/php/database.php';
	$where = "";
	$für = "Tests";
	$r_query = "";
	if (isset($_GET['r'])){
		$r_query = $_GET['r'];
		if ($r_query !== ""){
			$where = " WHERE file_name LIKE '%" . mysqli_real_escape_string($conn, $r_query) . "%'";
			$für = 'Suchergebnisse für "' . $r_query . '"';
		}
	} elseif (isset($_GET['q'])) {
		$r_query = $_GET['q'];
		$where = " LEFT JOIN subgebiete ON files.sub_name = subgebiete.sub_name WHERE subgebiete.tg_name = '" . mysqli_real_escape_string($conn, $r_query) . "' AND is_test = 1;";
		$für = "Tests für " . $_GET['q'];
	}

	//construct html elements
	$inserthtml = ['
		<div class="Linkbox">
			<h2><div>', '</div></h2>
			<div class="stylelinie"></div>
			<div class="Linkflex" id = "spanmax">',

			'<div><span class="link_first"><a target="_blank" href="../Tests/',
			'</a></span></div>',

			'</div>
		</div>
	'];

	$echo_html = "";
	$suchergebnisse = false;

	$files_query = "SELECT article_name, file_name FROM files" . $where;
	$filesResult = mysqli_query($conn, $files_query);

	$echo_html .= $inserthtml[0] . $für . $inserthtml[1];
	while ($file = mysqli_fetch_assoc($filesResult)) {
		$echo_html .= $inserthtml[2] . $file['file_name'] . '.pdf">' . $file['article_name']  . " - Test" . $inserthtml[3];
		$suchergebnisse = true;
	}
	$echo_html .= $inserthtml[4];

	$echo_html .= '<div class="google-search">Du hast nicht gefunden, was du suchst? Probiers doch mal <a  target="_blank" href="https://www.google.de/search?q=' . $r_query . '+site%3AAbicheck.de";>hier!</a></div>';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="icon" href="../Import/bilder/webcon2.png">
	<title>Tests</title>

	<!-- this specific -->
	<link rel="stylesheet" type="text/css" href="../Import/css/searchpage.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/search.css">

</head>

<body>
<!-----------HEADER-------COPY PASTE, BCS OF DIRECTORY PATH ----------------------->
	<link href="https://fonts.googleapis.com/css?family=Gelasio|Roboto&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 

<!--css alg-->
	<link rel="stylesheet" type="text/css" href="../Import/css/header.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/allgemeinformat.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/allgemeintop+fixed-format.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/header.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/footer.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/scrollup.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/main-content-widht.css">

<!--js tools-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--scroll up-->
	<script type="text/javascript" src="../Import/js/scrollup.js"></script>
	<script type="text/javascript" src="../Import/js/changeclass.js"></script>

<div id="nav2"> 
	<div class="navtop"> 
		<a href="../" class="logo-area"> 
			<div class="logo-img"></div> 
			<div class="logo-name">Abicheck</div> 
		</a> 

		<div class="navtop-rechts">
			<a href="#">Prüfungen</a>
			<div class="trenn"></div>
			<a href="../rechner/">Rechner</a>
		</div>
	</div> 
	<div class="zwischenlinie-b"></div> 
</div> 

<div class="zwischenlinie-a"></div>

<div class="left-fixed">
	<div class="left-fixed-list">
		<a class="fixed-head fixed-head-a" href="../">Startseite</a>
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
	<!--h1>Suchergebnisse</h1-->
	<div class="main-content">
		<div class="big-search">
			<div class="search-area">
				<form class="search">
					<input type="text" placeholder="Welchen Test suchst du?" name="r">
					<button type="submit"></button>
				</form>
			</div>
		</div>
		<?php echo $echo_html; ?>
	</div>

	<div class="scroll-up" id="scroll-up" tilte="Nach oben">
		<div class="arrow arrow1"></div>
		<div class="arrow arrow2"></div>
	</div>
</div>
<!-----------FOOTER-------COPY PASTE, BCS OF DIRECTORY PATH ----------------------->
<footer id="footer">
	<div>
		<div>
			<h2>Mathe lernen</h2>
			<ol>
				<li>Grundlagen</li>
				<li>Analysis</li>
				<li>Geometrie</li>
				<li>Stochastik</li>
			</ol>
		</div>
		<div>
			<h2>Mehr</h2>
			<ol>
				<li>Prüfungen</li>
				<li>Matherechner</li>
			</ol>
		</div>
		<div>
			<h2>Abicheck</h2>
			<ol>
				<li>Über uns</li>
				<li>Kontakt</li>
				<li>Impressum</li>
				<li>Datenschutz</li>
			</ol>
		</div>
	</div>
	<script type="text/javascript" src="../Import/js/scrollup.js"></script>
</footer>

</body>
</html>

