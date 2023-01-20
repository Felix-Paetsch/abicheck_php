<?php
	include_once 'Import/php/database.php';
	include_once 'Import/php/search.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="icon" href="Import/bilder/webcon2.png">
		<title>Suchen</title>

	<!-- this specific -->
	<link rel="stylesheet" type="text/css" href="Import/css/searchpage.css">
	<link rel="stylesheet" type="text/css" href="Import/css/search.css">

</head>

<body>
<?php include_once "Import/php/Sheader.php"; ?>

<div class="zwischenlinie-a"></div>

<div class="left-fixed">
	<div class="left-fixed-list">
		<a class="fixed-head fixed-head-a" href="Grundlagen/../">Startseite</a>
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
	<!--h1>Suchergebnisse</h1-->
	<div class="main-content">
		<div class="big-search">
			<div class="search-area">
				<form class="search" action="suche">
					<input type="text" placeholder="Was möchtest du lernen?" name="s">
					<button type="submit"></button>
				</form>
			</div>
		</div>
		<div class="suchergebnisse">Suchergebnisse für "<?php echo $q;?>":</div>
		<?php echo $echo_html ?>
		<div class="google-search">
			<?php
				if($i > 0){
					echo 'Du hast nicht gefunden, was du suchst? Probiers doch mal <a  target="_blank" href="https://www.google.de/search?q=' . $q . '+site%3AAbicheck.de";>hier!</a>';
				} else{
					echo 'Leider wurden keine Suchergebnisse gefunden. Probiere bitte die <a  target="_blank" href="https://www.google.de/search?q=' . $q . '+site%3AAbicheck.de";>Google Suche nach "' . $q . '".</a>';
				}
			?>
		</div>
	</div>

	<div class="scroll-up" id="scroll-up" tilte="Nach oben">
		<div class="arrow arrow1"></div>
		<div class="arrow arrow2"></div>
	</div>
</div>

<script type="text/javascript">
	function getMaxChildWidth(of) {
	    max = 0;
	    for (var k = 0; k < document.getElementById(of).childNodes.length; k++) {
		       c_width = document.getElementById("spanmax".concat(i)).childNodes[k].childNodes[0].offsetWidth; 
		       if (c_width > max){max = c_width;}
		}
	    return (max + 40).toString().concat("px");
	}

	var i;
	var maxwidth;
	for (i = 0; i < <?php echo $i ?>; i++) {
		maxwidth = getMaxChildWidth("spanmax".concat(i));
	  for (var j = 0; j < document.getElementById("spanmax".concat(i)).childNodes.length; j++) {
		       document.getElementById("spanmax".concat(i)).childNodes[j].childNodes[0].style.width = maxwidth; 
		}
	} 
</script>
<?php include_once "Import/php/Sfooter.php"; ?>

</body>
</html>

