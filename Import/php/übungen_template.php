<?php 
	if (strpos($_SERVER['REQUEST_URI'], 'übungen_template')){
		header("Location: ../../", true, 301);
		exit();
	}

	$style = QuerySQL("SELECT übungen_style FROM articles WHERE article_name = ?;", [$qname], "s");
	$echoStyle =  mysqli_fetch_assoc($style)['übungen_style'];

	$inserthtml = ['
		<div class="left-fixed">
		<div class="left-fixed-list">
			<a class="fixed-head fixed-head-a" href="../',

			'">Übersicht</a>
			<div class="fixed-head fixed-head-b">',

			'</div>
			<div class="fixed-ul">',

			'<a href="?',

			'</a>',

				'</div>
			</div>
		</div>'];

	$lfixed = QuerySQL("SELECT article_name FROM articles WHERE sub_name = ? ORDER BY reihenfolge", [$qdir], "s");
	$echoLeftFixed = $inserthtml[0] . $gebiet . $inserthtml[1] . $qdir . $inserthtml[2];
	while ($link = mysqli_fetch_assoc($lfixed)) {
		$echoLeftFixed .= $inserthtml[3] . $qdir . "/" . $link['article_name'] . '">' . $link['article_name'] . $inserthtml[4];
	}
	$echoLeftFixed .= $inserthtml[5];



	$labelhtml = ['<div id="label-REPLACE" class="label ','active','" onclick="
				removeClass(\'.label\', \'active\');
				addClass(\'#label-REPLACE\', \'active\');
				addClass(\'.aufgabe\', \'disnone\');
				removeClass(\'#aufgabeREPLACE\', \'disnone\');
			">REPLACE</div>'];

	$aufgabenhtml = [
		'<div class="aufgabe',' disnone','" id="aufgabeREPLACE">
			<div class="aufgabe-top">',
		'</div>
			<div class="exp-head" onclick="toggleClass(\'#arrowboxREPLACE\', \'exp-active\'); toggleClass(\'#solREPLACE\', \'disnone\'); toggleClass(\'#einblendenAREPLACE\', \'disnone\'); toggleClass(\'#ausblendenAREPLACE\', \'disnone\')">
				<span id="einblendenAREPLACE">Lösungen einblenden</span>
				<span class="disnone" id="ausblendenAREPLACE">Lösungen ausblenden</span>
				<div id="arrowboxREPLACE" class="arrowbox">
					<div class="exp-arrow"></div>
					<div class="exp-arrow exp-arrow2"></div>
				</div>
			</div>
			<div class="solution disnone" id="solREPLACE">
				<span class="lösungentitle">Lösungen:</span>'

	];
	
	$i = 1;
	//$is_ex kommt von import_tg.php
	while ($ex = mysqli_fetch_assoc($is_ex)) {
		if ($i == 1){
			$aufgabenbar = str_replace("REPLACE", $i, $labelhtml[0] . $labelhtml[1] . $labelhtml[2]);
			$aufgaben = str_replace("REPLACE", $i, $aufgabenhtml[0] . $aufgabenhtml[2]) . $ex['ex_aufgabe'] . str_replace("REPLACE", $i, $aufgabenhtml[3]) . $ex['ex_sol'] . '</div></div>';
		} else {
			$aufgabenbar .= str_replace("REPLACE", $i, $labelhtml[0] . $labelhtml[2]);
			$aufgaben .= str_replace("REPLACE", $i, $aufgabenhtml[0] . $aufgabenhtml[1] . $aufgabenhtml[2]) . $ex['ex_aufgabe'] . str_replace("REPLACE", $i, $aufgabenhtml[3]) . $ex['ex_sol'] . '</div></div>';
		}
		$i++;
	}

	$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="icon" href="../Import/bilder/webcon2.png">

	<title><?php echo isset($qname) ? $qname . " - Übungen" : "Abicheck"; ?></title>

	<!-- this specific -->
	<script type="text/javascript" src="../Import/js/changeclass.js"></script>
	<script type="text/javascript" src="../Import/js/slider.js"></script>

	<link rel="stylesheet" type="text/css" href="../Import/css/tools.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/übungen.css">

	<style>
		<?php
			echo $echoStyle;
		?>
	</style>
</head>

<body>
<?php include_once 'header.php'; 
	echo $echoLeftFixed;
?>

<div id="main-wrapper">
	<div class="main-content">
		<h3 class="title">
			<a href=<?php echo '"../' . $gebiet . '/?' . $qdir . "/" . $qname . '"' ;?>>
				<?php echo $qname; ?>
			</a> 
			<br>
			<span>Übungen</span>
		</h3>

		

<?php
	echo '<div class="aufgaben-bar">' . $aufgabenbar . "</div>" . $aufgaben;
?>
	</div>

	<div class="scroll-up" id="scroll-up" tilte="Nach oben">
		<div class="arrow arrow1"></div>
		<div class="arrow arrow2"></div>
	</div>
</div>


<?php include_once 'footer.php'; 
	  include_once 'feedback.php';
?>

</body>
</html>