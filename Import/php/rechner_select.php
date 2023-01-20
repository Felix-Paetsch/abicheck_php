<?php 
	include_once "../Import/php/rechnerList.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="icon" href="../Import/bilder/webcon2.png">
	<title>Rechner</title>

	<!-- this specific -->
	<link rel="stylesheet" type="text/css" href="../Import/css/searchpage.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/search.css">

</head>

<body>
<?php
	include_once "../Import/php/header.php"
?>

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
				<form class="search" artion="../Rechner/">
					<input type="text" placeholder="Welchen Rechner suchst du?" name="s">
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
<?php
	include_once "../Import/php/footer.php"
?>

</body>
</html>

