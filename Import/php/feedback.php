<link rel="stylesheet" type="text/css" href="../Import/css/feedback.css">
<div id="feedback-btn" onclick="feedbackClicked()">Feedback</div>
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
<script type="text/javascript" src="../Import/js/feedback.js"></script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>



<?php if(isset($_POST['feedback'])){
		$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
		if(strlen($_POST['feedback']) > 4){
			$sql = "INSERT INTO `feedback` (`fb_id`, `fb_time`, `fb_article`, `fb_text`, `fb_checked`, `fb_check_time`) VALUES (NULL, current_timestamp(), ?, ?, '0', NULL);";
			QuerySQL($sql, [$_SERVER['REQUEST_URI'], $_POST['feedback']], "ss");

			writeToFeedback($_POST['feedback']);
		}
		$conn->close();
	  }

	  function writeToFeedback($feedback){
	  	$fp = fopen('../Data/feedback.txt', 'a');
		fwrite($fp, getdatetime() . "\n" . $feedback . "\n");
		fclose($fp);
	  }
?>