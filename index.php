<?php
	include_once 'Import/php/database.php';
	//construct html elements
	$inserthtml = ['
		<div class="Linkbox">
			<h2><a href="',
				'"><div></div>','</a></h2>
			<div class="stylelinie"></div>

			<div class="Linkflex">',

			'<span><a href="',
			'</a></span>',

			'</div>
		</div>
	'];

	$themengebiete = QuerySQL("SELECT * FROM themengebiete");
	$echoTG = "";
	while ($tg = mysqli_fetch_assoc($themengebiete)) {
		$echoTG .= $inserthtml[0] . $tg['tg_name'] . $inserthtml[1] . $tg['tg_name'] . $inserthtml[2];
		$subgebiete = QuerySQL("SELECT * FROM subgebiete WHERE tg_name = ?", [$tg['tg_name']], "s");
		while ($subg = mysqli_fetch_assoc($subgebiete)) {
			$echoTG .= $inserthtml[3] . $tg['tg_name'] . '/#' . $subg['sub_name'] . '">' . $subg['sub_name'] . $inserthtml[4];
		}

		$echoTG .= $inserthtml[5];
	}

	$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="icon" href="Import/bilder/webcon2.png">
		<title>Abicheck</title>

	<!-- this specific -->
	<link rel="stylesheet" type="text/css" href="Import/css/startpage.css">
	<link rel="stylesheet" type="text/css" href="Import/css/search.css">

</head>

<body>
<?php include_once "Import/php/Sheader.php"; ?>

<div class="zwischenlinie-a"></div>

<div class="main-banner">
	<div class="banner-img">
		<div class="banner-img-img"></div>
	</div>
	<div class="banner-text">
		<h1>Abicheck</h1>
		<h6>Mathe einfach erklärt.</h6>
	</div>
</div>


<div class="left-fixed">
	<div class="left-fixed-list">
		<a class="fixed-head fixed-head-a" href="about">Über Abicheck</a>
		<div class="fixed-head fixed-head-b">Themengebiete</div>
		<div class="fixed-ul">
			<a href="Grundlagen/">Grundlagen</a>
			<a href="Geometrie/">Geometrie</a>
			<a href="Analysis/">Analysis</a>
			<a href="Stochastik/">Stochastik</a>
		</div>
	</div>
</div>


<div id="main-wrapper">
	<!--h2 class="leftbar">Hier steht Text</h2-->
	<div class="main-content">
		<h2 class="was-ist">Was ist Abicheck?</h2>
		<div class="description">
			<p>Abicheck ist eine kostenlose online Lernplattform. Hier findest du alles, was du für deine Abiturprüfung brauchst. Zu jedem Theme gibt es Tests und Übungen um dich besser vorzubereiten. </p>
			<!--p>leftbar |-> Eine Frage, die es wet ist gesehen zu werden, wie zb "Was ist abicheck"|| dummy text ersetzen || responsive, bei größerer Bereite |-> eher links, wie die restlichen seiten auch. das inkludiert auch "Abicheck, amthe einfahc lenren || ansonnsten -> Rechtschreibung, Header, footer || alernative / ersatz zu Arrow </p-->
			<div class="buttonflex">
				<a href="Tests"><h4>Tests</h4></a>
				<a href="Rechner"><h4>Matherechner</h4></a>
			</div>
		</div>
	<div class="big-search">
		<div class="search-area">
			<form class="search" action="suche">
				<input type="text" placeholder="Was möchtest du lernen?" name="s">
				<button type="submit"></button>
			</form>
		</div>
	</div>


<?php
	echo $echoTG;
?>
	</div>
	<div class="scroll-up" id="scroll-up" tilte="Nach oben">
		<div class="arrow arrow1"></div>
		<div class="arrow arrow2"></div>
	</div>
</div>

<?php include_once "Import/php/Sfooter.php"; ?>

</body>
</html>