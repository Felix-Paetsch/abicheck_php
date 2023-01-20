<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}

	//Nur ich kann zugreifen (meine IP)
	include_once '../Import/php/restrict-access.php';
	include_once '../Import/php/database.php';

	if(isset($_POST['update_name'])){
		$update_name_query = "UPDATE `contents` SET `content_name` = ? WHERE `contents`.`content_id` = ?; ";
		SaveQuerySQL($update_name_query, [$_POST['update_name'], $_GET['update_content_id']], "si");
	}

	$content_name = mysqli_fetch_assoc(QuerySQL("SELECT content_name FROM contents WHERE content_id = ?", [$_GET['update_content_id']], "i"))['content_name'];

	$exist_result = QuerySQL('SELECT sub_name FROM articles WHERE article_name = ?', [$_GET['article_name']], "s");
	if (mysqli_num_rows($exist_result) == 0){
		echo "Artikel existiert nicht.";
		die();
	}

	$sub_name = mysqli_fetch_assoc($exist_result)['sub_name'];
	$tg_result = QuerySQL('SELECT tg_name FROM subgebiete WHERE sub_name = ?', [$sub_name], "s");
	$tg_name = mysqli_fetch_assoc($tg_result)['tg_name'];

	$article_link = '<a href=../' . $tg_name . '/?' . urlencode($sub_name) . '/' . urlencode($_GET['article_name']) . '>' . $_GET['article_name'] . "</a>";
	$content_link =  '<a href=../' . $tg_name . '/?' . urlencode($sub_name) . '/' . urlencode($_GET['article_name']) . '#' . urlencode($content_name) . '>' 
									. $_GET['update_content_rf'] . ". " . $content_name . "</a>";

	$sytle_Q = QuerySQL("SELECT article_style FROM articles WHERE article_name = ?", [$_GET['article_name']], "s");
	$articleStyle = mysqli_fetch_assoc($sytle_Q)['article_style'];

	$decoded = htmlspecialchars_decode($_POST['updatecontent_value']);

	if($_POST['update_content'] == "Submit"){
		$update_content_query = "UPDATE `contents` SET `content_text` = ? WHERE `contents`.`content_id` = ?; ";
		SaveQuerySQL($update_content_query, [$_POST['updatecontent_value'], $_GET['update_content_id']], "si");
	}
?>

<style type="text/css">
	.top-name-link:hover{
		color: rgb(200,200,200);
		transition-duration: .3s;
	}

	.article-name{
		font-size: 30px;
		margin-top: 40px;
	}

	.content-name{
		font-size: 25px;
		margin-top: 10px;
		margin-bottom: -30px;
	}

	.content-name span{
		min-width: 600px;
		display: inline-block;
	}

	.update-update-form textarea{
		width: 1360px;
		margin-top: 20px;
		margin-bottom: 80px;
		height: 400px;
		padding: 5px;
		font-size: 16px;
		line-height: 20px;
	}

	.message{
		margin-top: 40px;
		font-size: 30px;
		color: #4ecba5;
	}


	form{
		width: 1350px;
	}

	form .button-wrapper{
		margin: 30px -20px 20px 0px;
		float: right;
	}

	form .button-wrapper input{
		font-size: 25px !important;
		margin-left: 0px !important;
	}

	form .button-wrapper input:nth-child(2){
		margin-left: 80px !important;
	}

	form .button-wrapper input:nth-child(3){
		margin-left: 80px !important;
		color: #4ecba5 !important;
		border-color: #4ecba5 !important;
	}

	form .button-wrapper input:nth-child(3):hover{
		color: #fff !important;
		background-color: #4ecba5 !important;
	}

	.rename-form{
		margin-top: 30px;
		margin-bottom: 30px;
	}

	.rename-form input[type="text"]{
		padding: 5px;
	}

	.rename-form input[type="submit"]{
		font-size: 16px;
		margin-left: 10px;
	}

	<?php
		echo $articleStyle;
	?>
</style>

<?php 
	echo $_POST['update_content'] != "Update content" ? $_POST['update_content'] == "Update" ? '<div class="message">Content Updated</div>' : '<div class="message">Content Submitted - Now live</div>' : "";
?>	
<div class="article-name top-name-link"><?php echo $article_link?></div>
<div class="content-name top-name-link"><?php echo $content_link ?></div>

<form  <?php echo 'action="articles.php?what=content&article_name=' . $_GET['article_name'] . "&update_content_rf=" . $_GET['update_content_rf'] . "&update_content_id=" . $_GET['update_content_id']
					. '&update_content_name=' . $content_name . '"';?> class="form-box rename-form" method="post">
	<label for="update_name">Umbenennen:</label>
	<input type="text" name="update_name" value=""/>
	<input type="submit" name="update_go" value="Submit">

	<!-- hidden input -->
	<input type="hidden" name="updatecontent_value" value=<?php echo '"' . htmlspecialchars($decoded) . '"' ?>/>
	<input type="hidden" name="update_content" value="Update"/>
</form>

<div class="form-box">
	<div class="code-prev"> 
		<div class="codebox" contenteditable="true" spellcheck="true">
			<?php
				$replace_backslash = str_replace('\\\\', '\\\\\\\\', $_POST['updatecontent_value']); 
				echo nl2br(str_replace("\begin", "\<s>.</s>begin", htmlspecialchars($replace_backslash)));
			?>
		</div>
		<div class="prevbox content-box" contenteditable="true" spellcheck="true">
			<?php
				$latex_replaced = str_replace('$$', '[$[$]$]', $decoded);
				$latex_replaced = str_replace('\\(', '[$($[', $latex_replaced);
				$latex_replaced = str_replace('\\)', ']$)$]', $latex_replaced);
				echo $latex_replaced;
			?>
		</div>
	</div>

	<form <?php echo 'action="articles.php?what=content&article_name=' . $_GET['article_name'] . "&update_content_rf=" . $_GET['update_content_rf'] . "&update_content_id=" . $_GET['update_content_id']
					. '&update_content_name=' . $content_name . '"';?> class="update-update-form" method="post">
		<div class="button-wrapper">
			<input type="submit" name="zurück" value="Zurück"/>
			<input type="submit" name="update_content" value="Update"/>
			<input type="submit" name="update_content" value="Submit"/>
		</div>
		<textarea name="updatecontent_value"><?php echo htmlspecialchars($decoded) ?></textarea>
	</form>
</div>