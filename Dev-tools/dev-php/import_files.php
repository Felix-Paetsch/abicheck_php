<?php
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}

$echoMessage = "";

function istest(){
	return !(isset($_GET['is_n_test']));
}
//21. 05. Flo BD
if(isset($_GET['new_file_text'])){
	$echoMessage = "<div class='is_uploaded'>File wurde hochgeladen.</div>";
	$sub_name = mysqli_fetch_assoc($exist_result)['sub_name'];

	$sql = "INSERT INTO `files` (`id`, `article_name`, `sub_name`, `file_name`, `file_link`, `is_test`) VALUES (NULL, ?, ?, ?, ?, ?); ";
	$params = [
		$article_name,
		$sub_name,
		$_GET['file_name'],
		$_GET['new_file_text'],
		istest()
	];

	SaveQuerySQL($sql, $params, "ssssi");

} elseif (isset($_GET['delete_file'])){
	$echoMessage = "<div class='is_deleted'>File wurde deleted.</div>";

	SaveQuerySQL("DELETE FROM `files` WHERE `files`.`id` = ?;", [$_GET['file_id']], "i");
}


$get_files_article_result = QuerySQL("SELECT * FROM files WHERE article_name = ?;", [$_GET['article_name']], "s");
$article_files_table = "";
$count = 0;
while ($one_file = mysqli_fetch_assoc($get_files_article_result)){
	$article_files_table .= "<tr>
		<th>" . $one_file['id'] . "</th>
		<th>" . $one_file['article_name'] . "</th>
		<th>" . $one_file['sub_name'] . "</th>
		<th>" . $one_file['file_name'] . "</th>
		<th>" . is_test($one_file['is_test']) . "</th>
		<th>" . htmlspecialchars($one_file['file_link']) . "</th>
		<th>"
		. "<form action='files.php'>
				<input class='delete' type='submit' name='delete_file' value='Delete'>
				 <input type='hidden' name='article_name' value='" . $_GET['article_name'] . "'>
				 <input type='hidden' name='file_id' value='" . $one_file['id'] . "'></form></th>
		</tr>";
	$count++;
}


$conn->close();
?>
<style type="text/css">
	.note{
		color: rgba(255,255,255,.6);
	}

	.submit_form textarea{
		height: 60px;
		width: 500px;
	}

	.submit_form{
		display: flex;
		flex-direction: row;
	}

	.article_name{
		margin: 20px 0px 20px 0px;
		font-size: 35px;
	}

	form.submit_form .submit_new{
		margin: 10px 0px 0px 50px;
		max-height: 50px;
		width: 200px;
	}

	form input[name = submitfile]{
		border: 2px solid #4ecba5;
		color: #4ecba5;
	}

	form input[name = submitfile]:hover{
		background: #4ecba5;
	}

	.existiert_schon{
		margin-top: 70px;
		padding-bottom: 50px;
		border-bottom: 2px solid white;
	}

	input[name=delete_file]{
		background: unset;
		border-radius: 30px;
		font-weight: inherit;
		font-size: 17px;
		font-family: inherit;
		padding: 2px 5px 2px 5px;
		min-width: 150px;
		border: 2px solid #ed2939;
		color: #ed2939;
	}

	input[name=delete_file]:hover{
		background: #ed2939;
		color: white !important;
		transition-duration: .3s;
	}

	.existiert_schon span{
		display: block;
		margin: 30px 0px 30px 0px;
		font-size: 25px;
	}

	.is_uploaded{
		font-size: 20px;
		color: #4ecba5;
	}

	.is_deleted{
		font-size: 20px;
		color: #ed2939;
	}

	.submit_form > div:nth-child(1){
		display: flex;
		flex-direction: column;
	}

	.submit_form > div:nth-child(1) div{
		margin-bottom: 20px;
	}
</style>

<?php 
	echo $echoMessage;
?>
<div class="note">Einfach Dateien hochladen / bearbeiten?</div>
<div class="article_name"><?php echo $article_name?></div>
<form class="submit_form" action="files.php">
<div>
	<div>
		<label for="file_name">Datei Name:</label>
		<input type="text" name="file_name">
	</div>
	<div>
		<label for="is_n_test">Kein Test?</label>
		<input type="checkbox" name="is_n_test">
	</div>
	<label for="new_file_text">HTML text:</label>
	<textarea name="new_file_text" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'><?php echo htmlspecialchars('<a href="../Tests/" target="_blank" class="test">
	<h4>Test</h4>
	<h6>Alles verstanden?</h6>
</a>');?>
	</textarea>
</div>
	<input class="submit_new" type="submit" name="submitfile" value="Submit new"/>
	<input type="hidden" name="article_name" value=<?php echo '"' . $article_name . '"';?>>
</form>

<div class="existiert_schon">
	<span>Schon existierende Dateien:</span>
	<table>
		<tr>
			<th>id</th>
			<th>article_name</th>
			<th>sub_name</th>
			<th>file_name</th>
			<th>is_test</th>
			<th>file_link</th>
			<th>delete?</th>
		</tr>
		<?php echo $article_files_table ?>
	</table>
</div>