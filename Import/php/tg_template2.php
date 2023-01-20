<?php
	$TG_info = mysqli_fetch_assoc(QuerySQL("SELECT * FROM themengebiete WHERE tg_name = ?;", [$gebiet], $parameterTypes = "s"));

	//construct html elements
	$inserthtml = ['
		<div class="Linkbox">
		<div class="anchor" id="','"></div>
			<h2>','</h2>
			<div class="stylelinie"></div>

			<div class="Linkflex">',

			'<span><a href="?',
			'</a></span>',

			'</div>
		</div>
	'];

	$subgebiete = QuerySQL("SELECT * FROM subgebiete WHERE tg_name = ?", [$gebiet], "s");

	$echoSubgebieteMitArticles = "";

	while ($subg = mysqli_fetch_assoc($subgebiete)) {
		$echoSubgebieteMitArticles .= $inserthtml[0] . str_replace(" ","-", $subg['sub_name']) . $inserthtml[1] . $subg['sub_name'] . $inserthtml[2];
		$articles = QuerySQL("SELECT article_name FROM articles WHERE sub_name = ? ORDER BY reihenfolge", [$subg['sub_name']], "s");
		
		while ($article = mysqli_fetch_assoc($articles)) {
			$echoSubgebieteMitArticles .= $inserthtml[3] . $subg['sub_name'] . '/' . $article['article_name'] . '">' . $article['article_name'] . $inserthtml[4];
		}
		$echoSubgebieteMitArticles .= $inserthtml[5];
	}
	
	if(isset($_POST['feedback'])){
		if(strlen($_POST['feedback']) > 4){
			$sql = "INSERT INTO `feedback` (`fb_id`, `fb_time`, `fb_article`, `fb_text`, `fb_checked`, `fb_check_time`) VALUES (NULL, current_timestamp(), ?, ?, '0', NULL);";
			QuerySQL($sql, [$_SERVER['REQUEST_URI'], $_POST['feedback']], "ss");

			writeToFeedback($_POST['feedback']);
		}
	}

	  function writeToFeedback($feedback){
	  	$fp = fopen('../Backup/feedback.txt', 'a');
		fwrite($fp, getdatetime() . "\n" . $feedback . "\n");
		fclose($fp);
	  }

	$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8"/>
	<link rel="icon" href="../Import/bilder/webcon2.png">
	<meta name="description" content= <?php echo '"' . explode("<", $TG_info['tg_introduction'])[0] . '"'?>>

	
	<title><?php echo isset($gebiet) ? $gebiet : "Abicheck"; ?></title>

	<!-- this specific -->
	<link rel="stylesheet" type="text/css" href="../Import/css/subpage.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/search.css">
	
	<script type="text/javascript" src="../Import/js/canvas2.js"></script>
	<script type="text/javascript" src="../Import/js/changeclass.js"></script>
	<script type="text/javascript" src="../Import/js/slider.js"></script>
</head>

<body>
	<?php include_once 'header.php'; ?>

	<div class="left-fixed">
		<div class="left-fixed-list">
			<a class="fixed-head fixed-head-a" href="../">Startseite</a>

			<a class="fixed-head fixed-head-b" href="#">Rechner</a>
			<div class="fixed-ul">
				<?php
					echo  $TG_info['rechner'];
				?>
			</div>
		</div>
	</div>

<div id="main-wrapper">
	<div class="main-content">
		<h1 class="bighead"><?php echo $gebiet ?></h1>
		<div class="description">
			<p>
				<?php
					echo  $TG_info['tg_introduction'];
				?>
			</p>
			<div class="buttonflex">
				<?php
					echo $TG_info['link_blue'];
				?>
			</div>
		</div>

	<div class="big-search">
		<div class="search-area">
			<form class="search" action="../suche">
				<input type="text" placeholder="Was möchtest du lernen?" name="s">
				<button type="submit"></button>
			</form>
		</div>
	</div>

<?php
	echo $echoSubgebieteMitArticles;
?>
		
	</div>
	<div class="scroll-up" id="scroll-up" tilte="Nach oben">
		<div class="arrow arrow1"></div>
		<div class="arrow arrow2"></div>
	</div>
</div>

<script type="text/javascript">
function feedbackClicked(){
	$('#feedback-overlay').removeClass('disnone');
}

function overlayClicked(){
	$('#feedback-overlay').addClass('disnone');
}
</script>
<link rel="stylesheet" type="text/css" href="../Import/css/TG_feedback.css">

<div id="feedback-overlay" class="disnone">
	<div class="overlayEscape"onclick="overlayClicked()" ></div>
	<form method="POST">
		<div class="formtoptext">
			<h2>Feedback</h2>
			<p>Hast du einen Verbesserungsvorschlag oder wünschst dir noch mehr Erklärungen? Dann kannst du mir das hier mitteilen.</p>
		</div>
		<textarea name="feedback" spellcheck="false" placeholder="Dein Feedback..."></textarea>
		<input type="submit" name="stuff" value="Abschicken">
	</form>
</div>

<script>
	//don't send feedback again on reload
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php include_once 'footer.php'; ?>

</body>
</html>