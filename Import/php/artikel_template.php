<?php 
	if (strpos($_SERVER['REQUEST_URI'], 'artikel_template')){
		header("Location: ../../", true, 301);
		exit();
	}

	$article_info = mysqli_fetch_assoc(QuerySQL("SELECT article_style, article_meta FROM articles WHERE article_name = ?;", [$qname], "s"));
	$article_style =  $article_info['article_style'];
	$article_description = $article_info['article_meta'];

	$inserthtml = ['
		<div id="left-fixed" class="left-fixed">
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


	$lfixed = QuerySQL("SELECT article_name FROM articles WHERE sub_name = ?;", [$qdir], "s");

	$echoLeftLinks = $inserthtml[0] . $gebiet . $inserthtml[1] . $qdir . $inserthtml[2];
	while ($link = mysqli_fetch_assoc($lfixed)) {
		$echoLeftLinks .= $inserthtml[3] . $qdir . "/" . $link['article_name'] . '">' . $link['article_name'] . $inserthtml[4];
	}

	$echoLeftLinks .= $inserthtml[5];

	$inhalt = QuerySQL("SELECT content_name FROM contents WHERE sub_name = ? AND article_name = ? ORDER BY reihenfolge;", [$qdir, $qname], "ss");
	$echoInhalt = '';
	$i = 1;
	while ($inhalt_link = mysqli_fetch_assoc($inhalt)) {
		$echoInhalt .= '<a href="#' . str_replace(" ","-", $inhalt_link['content_name']) . '">' . $i . '. ' . $inhalt_link['content_name'] . '</a>';
		$i++;
	}

	
	$is_ex = QuerySQL("SELECT ex_id FROM exercises WHERE sub_name = ? AND article_name = ?", [$qdir, $qname], "ss");
	$isex = mysqli_num_rows($is_ex);
	$inhalt_box_html = "";
	
	if($isex > 0){
		$inhalt_box_html .= '<a href="../' . $gebiet . '/?' . $qdir . "/" . $qname . '-Übungen" class="übungen">
				<h4>Übungen</h4><h6>So wirds gemacht</h6></a>';
	}

	$files = QuerySQL("SELECT file_link FROM files WHERE sub_name = ? AND article_name = ?", [$qdir, $qname], "ss");
	while ($file = mysqli_fetch_assoc($files)) {
		$inhalt_box_html .= $file['file_link'];
	}

	$rechner = QuerySQL("SELECT rechner_id FROM rechner WHERE article_name = ?", [$qname], "s");
	if (mysqli_num_rows($rechner) > 0){
		$inhalt_box_html .= '<a href="../rechner/?Artikel=' . $qname . '" class="rechner"><h4>Rechner</h4><h6>Deine Aufgaben</h6></a>';
	}



	$contenthtml = ['
		<div class="box content-box">
			<div class="anchor" id="','"></div>
			<h3 class="topic">'
	];
	$contents = QuerySQL("SELECT content_name, content_text FROM contents WHERE sub_name = ? AND article_name = ? ORDER BY reihenfolge;", [$qdir, $qname], "ss");
	$echoContents = '';
	$i = 1;
	while ($content = mysqli_fetch_assoc($contents)) {
		$echoContents .= $contenthtml[0] . str_replace(" ","-", $content['content_name']) . $contenthtml[1] . $i . '. ' . $content['content_name'] . '</h3>' . $content['content_text'] . '</div>';
		$i++;
	}
	$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="description" content= <?php echo $article_description;?>>

	<link rel="icon" href="../Import/bilder/webcon2.png">

	<title><?php echo isset($qname) ? $qname : "Abicheck"; ?></title>

	<!-- this specific -->
	<script type="text/javascript" src="../Import/js/changeclass.js"></script>
	<script type="text/javascript" src="../Import/js/slider.js"></script>

	<link rel="stylesheet" type="text/css" href="../Import/css/tools.css">
	<style type="text/css">
		<?php
			echo $article_style;
		?>
	</style>
</head>

<body>
<?php include_once 'header.php'; ?>

<?php
	echo $echoLeftLinks;
?>

<div id="main-wrapper">
	<div class="main-content">
		<h3 class="title"><?php echo $qname ?></h3>
		<div class="box inhalt">
			<div class="topic">Inhalt</div>
			<div class="topic-ul">
				<?php
					echo $echoInhalt;
				?>
			</div>
			<div class="inhalt-box">
				<?php 
					echo $inhalt_box_html;
				?>
			</div>
		</div>

<?php
	echo $echoContents;
?>
		<div class="mobile-end">
			<?php 
					echo $inhalt_box_html;
			?>
		</div>
	</div>

	<div class="scroll-up" id="scroll-up" tilte="Nach oben">
		<div class="arrow arrow1"></div>
		<div class="arrow arrow2"></div>
	</div>
</div>

<?php 
	include_once 'feedback.php';
	include_once 'footer.php'; 
?>

</body>
</html>