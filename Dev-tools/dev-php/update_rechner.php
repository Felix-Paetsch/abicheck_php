<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}

if(isset($_POST['submit_rechner_update'])){
	$update_rechner_query = "UPDATE `rechner` SET 
		`rechner_name` = ?, `article_name` = ?, `import_filesJsCss_AndMeta` = ?, `rechner_input` = ?,  `rechner_output` = ?,
		`ref_link` = ?, `JSscript` = ?, `import_filesPHP` = ? WHERE rechner_id = ?;";

	$params = [
		$_POST['rechner_name'],
		$_POST['article_name'],
		$_POST['import_filesJsCss_AndMeta'],
		$_POST['rechner_input'],
		$_POST['rechner_output'],
		$_POST['ref_link'],
		$_POST['JSscript'],
		$_POST['import_filesPHP'],
		$_GET['rechner_id']
	];

	SaveQuerySQL($update_rechner_query, $params, "ssssssssi");
}

$rechner = mysqli_fetch_assoc(QuerySQL("SELECT * FROM rechner WHERE rechner_id = ?", [$_GET['rechner_id']], "i"));;
?>
<style type="text/css">
	.rechner-id{
		font-size: 30px;
		margin: 20px 0px 30px 0px;
	}	

	.section-name{
		font-size: 19px;
		margin:0px 0px 10px 0px;
	}

	.updateform{
		display: flex;
		flex-direction: column !important;
	}

	.form-flex{
		display: flex;
		flex-direction: row;
		width: 1500px;
		margin-bottom: 30px;
	}

	.current{
		width: 700px;
		padding: 40px;
		margin-right: 100px;
		background-color: rgb(90,90,90);
		box-sizing: border-box;
	}

	textarea{
		padding: 40px;
		box-sizing: border-box;
		width: 700px;
	}

	input[name = submit_rechner_update]{
		border: 2px solid #4ecba5;
		color: #4ecba5;
		width: 300px;
		font-size: 25px;
		box-sizing: border-box;
		margin-left: 1120px;
	}

	input[name = submit_rechner_update]:hover{
		background: #4ecba5;
		color: white;
	}

	.suc{
		margin:20px 0px 40px 0px;
		font-size: 30px;
		color: #4ecba5;
	}
</style>

<?php if(isset($_POST['submit_rechner_update'])){
	echo "<div class='suc'>Update now live</div>";
}?>
<div class="rechner-id">
	Rechner ID: <?php echo $rechner['rechner_id'];?>
</div>
<div class="update">
	<form class="updateform" method="POST" action=<?php echo '"rechner.php?rechner_id=' . $_GET['rechner_id'] . '"'; ?>>
		<div class="form-section">
			<div class="section-name">Rechner_name</div>
			<div class="form-flex">
				<div class="current"><?php echo nl2br(htmlspecialchars($rechner['rechner_name']));?></div>
				<textarea name="rechner_name"><?php echo htmlspecialchars($rechner['rechner_name']);?></textarea>
			</div>
		</div>
		<div class="form-section">
			<div class="section-name">Article_name</div>
			<div class="form-flex">
				<div class="current"><?php echo nl2br(htmlspecialchars($rechner['article_name']));?></div>
				<textarea name="article_name"><?php echo htmlspecialchars($rechner['article_name']);?></textarea>
			</div>
		</div>
		<div class="form-section">
			<div class="section-name">import_filesJsCss_AndMeta</div>
			<div class="form-flex">
				<div class="current"><?php echo nl2br(htmlspecialchars($rechner['import_filesJsCss_AndMeta']));?></div>
				<textarea name="import_filesJsCss_AndMeta"><?php echo htmlspecialchars($rechner['import_filesJsCss_AndMeta']);?></textarea>
			</div>
		</div>
		<div class="form-section">
			<div class="section-name">rechner_input</div>
			<div class="form-flex">
				<div class="current"><?php echo nl2br(htmlspecialchars($rechner['rechner_input']));?></div>
				<textarea name="rechner_input"><?php echo htmlspecialchars($rechner['rechner_input']);?></textarea>
			</div>
		</div>
		<div class="form-section">
			<div class="section-name">rechner_output</div>
			<div class="form-flex">
				<div class="current"><?php echo nl2br(htmlspecialchars($rechner['rechner_output']));?></div>
				<textarea name="rechner_output"><?php echo htmlspecialchars($rechner['rechner_output']);?></textarea>
			</div>
		</div>
		<div class="form-section">
			<div class="section-name">ref_link</div>
			<div class="form-flex">
				<div class="current"><?php echo nl2br(htmlspecialchars($rechner['ref_link']));?></div>
				<textarea name="ref_link"><?php echo htmlspecialchars($rechner['ref_link']);?></textarea>
			</div>
		</div>
		<div class="form-section">
			<div class="section-name">JSscript</div>
			<div class="form-flex">
				<div class="current"><?php echo nl2br(htmlspecialchars($rechner['JSscript']));?></div>
				<textarea name="JSscript"><?php echo htmlspecialchars($rechner['JSscript']);?></textarea>
			</div>
		</div>
		<div class="form-section">
			<div class="section-name">import_filesPHP</div>
			<div class="form-flex">
				<div class="current"><?php echo nl2br(htmlspecialchars($rechner['import_filesPHP']));?></div>
				<textarea name="import_filesPHP"><?php echo htmlspecialchars($rechner['import_filesPHP']);?></textarea>
			</div>
		</div>
		<a href="rechner" class="zurück">Zurück</a>
		<input type="submit" name="submit_rechner_update" value="submit">
	</form> 
</div>