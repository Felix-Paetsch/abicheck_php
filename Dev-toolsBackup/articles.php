<?php 
	//Nur ich kann zugreifen (meine IP)
	include_once '../Import/php/restrict-access.php';
	include_once '../Import/php/database.php';
	
	if (isset($_GET['what'])){
		if($_GET['what'] == "exercises" && isset($_GET['add_new_ex'])){
			include_once 'dev-php/add_new_ex.php';
		}
	}
?>


<!DOCTYPE html>
<html>
<head>

	<title>Articles</title>

	<?php include_once "ScriptIncludeStuff.php" ?>
	<link rel="stylesheet" type="text/css" href="../Import/css/tools.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/übungen.css">


	<link rel="stylesheet" type="text/css" href="../Import/css/allgemeinformat.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/header.css">

	<style type="text/css">
		.content-box p a{
			font-style: italic !important;
			display: inline !important;
			margin: unset !important;
			font-size: inherit !important;
			color: inherit !important; 
			text-decoration-line: underline !important;
			cursor: pointer !important;
		}

		.content-box p a:hover{
			color: rgb(80,80,80) !important;
		}

		body{
			background-color: #22232a;
			padding: 0px;
			margin:0px;
			overflow-x: hidden;
		}

		.main{
			min-height: 100vh;
			width: 100vw;
			padding:20px 50px 50px 50px;
			box-sizing: border-box;
			font-family: 'MuseoModerno', cursive;
			color: white;
		}

		.zurück, .top{
			font-size: 50px;
			text-decoration-line: none;
			padding-top:50px;
			color: white;
		}

		.topbar{
			margin: 0px 50px 0px 50px;
			background-color: #fff;
			width: 5px;
			height: 30px;
			border-radius: 20px;
			display: inline-block;
		}

		.zurück:hover{
			color: rgb(200,200,200);
			transition-duration: .3s;
		}

		.line1{
			margin-top: -10px;
			width: calc(100vw - 100px);
			height: 5px;
			background-color: #FFF;
			border-radius: 20px;
		}

		.top_select{
			margin-top: 20px;
			display: flex;
			flex-direction: row;
		}

		.name{
			margin-left: 50px;
		}

		.name input{
			height: 45px;
		}

		.top_select div:nth-child(2) input{
			margin-left: 20px;
			width: 300px;
			font-family: 'MuseoModerno', cursive;
			font-size: 18px;
			padding-left: 10px;
		}

		.top_select label{
			font-size: 25px;
		}

		.top_select div{
			display: flex;
			flex-direction: row;
		}

		.top_select select{
		  /* ... */
		  width: 300px;
		  height: 45px;
		  padding-left: 10px;
		  color: #fff;
		  background-color: unset;
		  font-size: 20px;
		  margin-left: 20px;
		}

		select {

		  /* styling */
		  background-color: white;
		  border: thin solid blue;
		  border-radius: 4px;
		  display: inline-block;
		  font: inherit;
		  line-height: 1.5em;
		  /* reset */

		  margin: 0;      
		  -webkit-box-sizing: border-box;
		  -moz-box-sizing: border-box;
		  box-sizing: border-box;
		  -webkit-appearance: none;
		  -moz-appearance: none;

		  border: 2px #187bcd solid;
		  border-radius: 30px;
		}


		/* arrows */

		select.classic {
			background-image:
			    linear-gradient(45deg, transparent 50%, #187bcd 50%),
			    linear-gradient(135deg, #187bcd 50%, transparent 50%),
			    linear-gradient(to right, #ccc, #ccc);
			  background-position:
			    calc(100% - 30px) calc(17px),
			    calc(100% - 20px) calc(17px),
			    calc(100% - 2.5em) 0.5em;
			  background-size:
			    10px 10px,
			    10px 10px,
			    0px 1.5em;
			  background-repeat: no-repeat;
			}

		select option{
			background: unset;
			font: inherit;
		}

		.submit_new{
			background: unset;
			border-radius: 30px;
			font-weight: inherit;
			font-size: 20px;
			font-family: inherit;
			padding: 5px 10px 5px 10px;
			min-width: 150px;
			border: 2px solid #187bcd;
			color: #187bcd;
			margin-left: 50px;
		}

		.submit_new:hover{
			background: #187bcd;
			color: white !important;
			transition-duration: .3s;
		}

		.new_article{
			margin-left: 10px;
			color: #4ecba5;
			border-color: #4ecba5;
		}

		.new_article:hover{
			background: #4ecba5;
		}

		.disnone{
			display: none;
		}

		.add form, .update form{
			display: flex;
			flex-direction: row;
		}

		.new_article_wrapper .add form div:nth-child(1) textarea {width: 150px;}
		.new_article_wrapper .add form div:nth-child(2) textarea {width: 150px;}
		.new_article_wrapper .add form div:nth-child(3) textarea {width: 230px;}
		.new_article_wrapper .add form div:nth-child(4) textarea {width: 230px;}
		.new_article_wrapper .add form div:nth-child(5) textarea {width: 230px;}

		.submit_go{
			background: unset;
			border-radius: 30px;
			font-weight: inherit;
			font-size: inherit;
			font-family: inherit;
			padding: 5px 10px 5px 10px;
			min-width: 150px;
			margin-top: 35px;
		}

		.add .submit_go{
			margin-left: 10px;
			border-color: #187bcd;
			color: #187bcd;
		}

		.add_sub .submit_go{
			margin-left: 200px;
		}

		.add div , .update div{
			margin-right: 20px;
		}

		.main-order .first-row{
			margin-top: 20px;
			font-size:30px;
			display: flex;
			flex-direction: row;
		}

		.first-row .trenn{
			margin: 0px 70px 0px 70px;
		}

		.show_link a{
			color: white;
			text-decoration-line: none;
			cursor: pointer;
		}

		.show_link a:hover{
			color: rgb(200, 200, 200);
			transition-duration: .3s;
		}

		.result{
			max-width: 1210px;
		}

		table{
			margin-top: 80px;
			text-align: left;
			font-family: 'Roboto', sans-serif;
			float: left;
		}

		table tr th:nth-child(1){
			width: 100px;
		}

		table tr th:nth-child(2){
			width: 600px;
		}

		table tr th:nth-child(3){
			width: 100px;
		}

		.meta-table{
			margin-bottom: 70px;
		}

		.meta-table tr th form div{
			display: flex;
			flex-direction: column;
			text-align: center;
		}

		.meta-table tr th form div input[type = submit]{
			background: unset;
			border-radius: 30px;
			font-weight: inherit;
			font-size: 20px;
			font-family: inherit;
			padding: 5px 10px 5px 10px;
			border: 2px solid #187bcd;
			color: #187bcd;
			margin-top: 10px;
			width: 150px;
			display: inline-block;
			box-sizing: border-box;
			margin-left: calc(50% - 75px);
		}

		.meta-table tr th form div input[type = submit]:hover{
			background: #187bcd;
			color: white !important;
			transition-duration: .3s;
		}

		.meta-table tr th:nth-child(2){
			width: 100px;
		}

		.meta-table tr th:nth-child(3){
			width: 250px;
		}

		.meta-table tr th:nth-child(4){
			width: 250px;
		}

		.meta-table tr th:nth-child(5){
			width: 250px;
		}

		.meta-table tr th:nth-child(6){
			width: 250px;
		}

		table tr th{
			padding-top: 10px;
			padding-right: 10px;
		}

		table tr{
			padding-right: 10px;
		}

		table tr:nth-child(1) th{
			padding-bottom: 20px;
		}

		form.set_order{
			float: right;
			margin-top: 80px;
		}

		form.set_order > div{
			margin-top: 10px;
		}

		.submit_rhf{
			margin-left: 0px;
			margin-top: 20px;
			padding: 2px 10px 2px 10px;
			color: #4ecba5;
			border-color: #4ecba5;
		}

		.submit_rhf:hover{
			background-color: #4ecba5;
		}

		.remove{
			margin-top: 300px;
			width: 700px;
		}

		.top_name{
			font-family: 'MuseoModerno', cursive;
			font-size: 25px;
		}

		.editorlink{
			text-decoration-line: none;
			color: white;
		}

		.editorlink:hover{
			color: rgb(200,200,200);
			transition-duration: .3s;
		}

		.div-meta{
			max-width: 1350px;
		}

		.inhalt_links a{
			color: white;
			text-decoration-line: none;
			display: block;
			text-decoration-line: none;
			font-size: 20px;
			margin-top: 10px;
			margin-left: 20px;
		}

		.inhalt_links a span{
			min-width: 300px;
			display: inline-block;
		}

		.inhalt_links a:hover{
			color: rgb(200,200,200);
			transition-duration: .3s;
		}

		.inhalt_links a:nth-child(1){
			font-size: 27px;
			margin-top: 40px;
			margin-left: 0px;
		}

		.content_top_wrapper{
			display: flex;
			flex-direction: row;
		}

		.content_top_wrapper .top_wrapper_trenn{
			height: 250px;
			width: 3px;
			margin: 60px 90px 30px 130px;
			border-radius: 3px;
			background-color: white;
		}

		.top_wrapper_rigth{
			display: flex;
			flex-direction: column;
		}

		.top_wrapper_right a:nth-child(1){
			margin-top: 105px;
		}

		.top_wrapper_right a{
			color: white;
			text-decoration-line: none;
			display: block;
			text-decoration-line: none;
			font-size: 20px;
			margin-top: 10px;
			font-size: 30px;
		}

		.top_wrapper_right a:hover{
			color: rgb(200,200,200);
			transition-duration: .3s;
		}


	/* biiiiig fooooorm styyyyyle */

		.form-box{
			margin-top: 60px;
		}

		.form-box a{
			color: white;
			text-decoration-line: none;
			display: block;
			text-decoration-line: none;
			font-size: 20px;
			margin-top: 10px;
			font-size: 30px;
		}

		.form-box a span{
			min-width: 700px;
			display: inline-block;
		}

		.form-box a:hover{
			color: rgb(200,200,200);
			transition-duration: .3s;
		}

		.form-box .code-prev{
			display: flex;
			flex-direction: row;
			margin-top: 30px;
		}

		.form-box .codebox{
			width: 500px;
			padding: 40px;
			background-color: rgb(90,90,90);
		}

		.form-box .prevbox{
			background-color: rgb(200,200,200);
			width: 700px;
			padding: 40px;
			padding-left: 5px;
			margin-left: 40px;
			color: black;
		}

		s{display: none;}

		.flex-top{
			display: flex;
			flex-direction: row;
			margin-top: 20px;
		}

		.flex-top-title{
			font-size: 28px;
		}

		.content_form textarea{
			width: 1360px;
			margin-top: 20px;
			margin-bottom: 80px;
		}

		.form-box input[type = submit]{
			background: unset;
			border-radius: 30px;
			font-weight: inherit;
			font-size: 17px;
			font-family: inherit;
			padding: 2px 10px 2px 10px;
			border: 2px solid #187bcd;
			color: #187bcd;
			width: 150px;
			box-sizing: border-box;
			margin-left: 100px;
			margin-top: 5px;
		}

		.form-box input[type = submit]:hover{
			background: #187bcd;
			color: white !important;
			transition-duration: .3s;
		}

		.inhalt_links .form-box{
			margin-top: 20px;
		}

		input[name=add_new_content]{
			margin-left: 30px !important;
			margin-top: 0px !important;
			width: 300px !important;
			color: #4ecba5 !important;
			border-color: #4ecba5 !important;
		}

		input[name=add_new_content]:hover{
			background: #4ecba5 !important;
		}
	</style>
</head>
<?php
//update content name
if(isset($_POST['update_name'])){
		$update_name_query = "UPDATE `contents` SET `content_name` = '" . $_POST['update_name'] . "' WHERE `contents`.`content_id` = '" . $_GET['update_content_id'] . "'; ";
		mysqli_query($conn, $update_name_query);
	}

//update article php
if(isset($_GET['update_submit'])){
	if(isset($_GET['new_article_name'])){
		$key = "article_name";
		$value = $_GET['new_article_name'];
	}
	if(isset($_GET['sub_name'])){
		$key = "sub_name";
		$value = $_GET['sub_name'];
	}
	if(isset($_GET['article_meta'])){
		$key = "article_meta";
		$value = $_GET['article_meta'];
	}
	if(isset($_GET['article_style'])){
		$key = "article_style";
		$value = $_GET['article_style'];
	}
	if(isset($_GET['übungen_style'])){
		$key = "übungen_style";
		$value = $_GET['übungen_style'];
	}
$update_meta_query = "UPDATE `articles` SET " . $key . " = '" . mysqli_real_escape_string($conn, $value) . "' WHERE `articles`.`article_name` = '" . $_GET['article_name'] ."' ; ";
mysqli_query($conn, $update_meta_query);
}
?>
<body>
	<div class="main">
		<a class ="zurück" href="../Dev-tools">Zurück</a>
		<span class="topbar"></span>
		<span class="top">Articles</span>
		<span class="topbar"></span>
		<span class="top" style="color: #187bcd;"><?php 
			if(isset($_GET['article_name']) && $_GET['article_name'] != ""){echo $_GET['article_name'];} else {echo 'Foli';}?>
		</span>
		<div class="line line1"></div>

		<form class="top_select" action="articles.php">
			<div>
				<label for="where">Bearbeiten:</label><br>
				<select name="what" class="classic">
					<option value="meta">Article - META</option>
					<option value="content">Article - CONTENT</option>
					<option value="exercises">Article - EXERCISES</option>
				</select> 
			</div>
			<div class="name">
				<label for="article_name">Name:</label><br>
				<input type="text" name="article_name">
			</div>
			<div>
				<input class="submit_new" type="submit" name="search" value="Search"/>
			</div>
			<div>
				<input class="submit_new new_article" type="submit" name="new_article" value="Neuer Artikel"/>
			</div>
		</form>


<?php if (!isset($_GET["new_article"]) && !isset($_GET["search"])){ echo '<div class = "disnone">';} else {echo '<div class="main-order">';}?>

<?php if (isset($_GET["new_article"])){ echo '<div class = "new_article_wrapper">';} else {echo '<div class="disnone">';}?>
	<div class="add">
		<div class="top_name">ADD</div>
		<form action="articles.php">
			<div>
				<label for="article_name">Article - Name:</label><br>
				<textarea name="article_name" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
			</div>
			<div>
				<label for="sub_name">Sub - Name:</label><br>
				<textarea name="sub_name" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
			</div>
			<div>
				<label for="article_meta">Article - Meta:</label><br>
				<textarea name="article_meta" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
			</div>
			<div>
				<label for="article_style">Article - Style:</label><br>
				<textarea name="article_style" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
			</div>
			<div>
				<label for="übungen_style">Übungen - Style:</label><br>
				<textarea name="übungen_style" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
			</div>
			<input type="hidden" name="what"value="meta">
			<div>
				<input class="submit_go submit_new" type="submit" name="add_new_article" value="Add"/>
			</div>
		</form> 
	</div>
</div>
</div>

<?php 
	if (isset($_GET["add_new_article"]) && $_GET["article_name"] != ""){
	$exist_query = 'SELECT article_id FROM articles WHERE article_name = "'. $_GET['article_name'] .'"';
	$exist_result = mysqli_query($conn, $exist_query);
	if (mysqli_num_rows($exist_result) == 0){
		$max_rhf =  mysqli_fetch_assoc(mysqli_query($conn, 'SELECT MAX( reihenfolge ) as reihenfolge FROM articles WHERE sub_name = "'. $_GET['sub_name'] .'"'))['reihenfolge'] + 1;

		$mysqli_query = 
			"INSERT INTO `articles` (`article_id`, `article_name`, `sub_name`, `article_style`, `übungen_style`, `reihenfolge`, `article_meta`) VALUES (NULL, '"  . mysqli_real_escape_string($conn, $_GET["article_name"]) . "', '" . mysqli_real_escape_string($conn, $_GET['sub_name']) . "', '" . mysqli_real_escape_string($conn, $_GET['article_style']) . "', '" . mysqli_real_escape_string($conn, $_GET['übungen_style']) . "', '" . mysqli_real_escape_string($conn, $max_rhf) . "', '" . mysqli_real_escape_string($conn, $_GET['article_meta']) . "'); ";
		mysqli_query($conn, $mysqli_query);
	} else {echo '<br> Artikel existierte schon';}
}?>
<?php if (!isset($_GET["new_article"]) && isset($_GET['article_name']) && $_GET['what'] == 'meta'){
	$meta_query = "SELECT * FROM articles WHERE article_name = '" . $_GET['article_name'] . "';";
	$meta_run = mysqli_query($conn, $meta_query);
	echo "<div class='div-meta'>";
}	else{echo "<div class = 'disnone'";}
?>

<table class="meta-table">
	<tr>
		<th>ID</th>
		<th>ARTICLE_NAME</th>
		<th>SUB_NAME
		<th>META</th>
		<th>ARTICLE_STYLE</th>
		<th>ÜBUNGEN_STYLE</th>
	</tr>
<?php	if(mysqli_num_rows($meta_run) == 0){echo "kein Artikel gefunden";}else{

	$echo_meta = '';
	while ($meta_th = mysqli_fetch_assoc($meta_run)) {
		$echo_meta .= '<tr>';
		$echo_meta .= '<th>'. htmlspecialchars($meta_th['article_id']) . '</th>';
		$echo_meta .= '<th>'. htmlspecialchars($meta_th['article_name']) . '</th>';
		$echo_meta .= '<th>'. htmlspecialchars($meta_th['sub_name']) . '</th>';
		$echo_meta .= '<th>'. htmlspecialchars($meta_th['article_meta']) . '</th>';
		$echo_meta .= '<th><pre>'. htmlspecialchars($meta_th['article_style']) . '</pre></th>';
		$echo_meta .= '<th><pre>'. htmlspecialchars($meta_th['übungen_style']) . '</pre></th>';
		$echo_meta .= '</tr>';
		$echo_meta .= '<tr>';
		$echo_meta .= '<th></th> <th><form action="articles.php">
							<div>
					<textarea name="new_article_name" oninput=\'this.style.height = "";this.style.height = this.scrollHeight + "px"\'></textarea>
					<input type="hidden" name="what" value ="meta">
					<input type="hidden" name="article_name" value ="' . $_GET['article_name'] . '">
					<input type="submit" name="update_submit" value="Update">
							</div></form></th>';
		$echo_meta .= '<th><form action="articles.php">
							<div>
					<textarea name="sub_name" oninput=\'this.style.height = "";this.style.height = this.scrollHeight + "px"\'></textarea>
					<input type="hidden" name="what" value ="meta">
					<input type="hidden" name="article_name" value ="' . $_GET['article_name'] . '">
					<input type="submit" name="update_submit" value="Update">
							</div></form></th>';
		$echo_meta .= '<th><form action="articles.php">
							<div>
					<textarea name="article_meta" oninput=\'this.style.height = "";this.style.height = this.scrollHeight + "px"\'></textarea>
					<input type="hidden" name="what" value ="meta">
					<input type="hidden" name="article_name" value ="' . $_GET['article_name'] . '">
					<input type="submit" name="update_submit" value="Update">
							</div></form></th>';
		$echo_meta .= '<th><form action="articles.php">
							<div>
					<textarea name="article_style" oninput=\'this.style.height = "";this.style.height = this.scrollHeight + "px"\'></textarea>
					<input type="hidden" name="what" value ="meta">
					<input type="hidden" name="article_name" value ="' . $_GET['article_name'] . '">
					<input type="submit" name="update_submit" value="Update">
							</div></form></th>';
		$echo_meta .= '<th><form action="articles.php">
							<div>
					<textarea name="übungen_style" oninput=\'this.style.height = "";this.style.height = this.scrollHeight + "px"\'></textarea>
					<input type="hidden" name="what" value ="meta">
					<input type="hidden" name="article_name" value ="' . $_GET['article_name'] . '">
					<input type="submit" name="update_submit" value="Update">
							</div></form></th>';
	}
echo $echo_meta;
}
?>

</table>
	<div class="top_name">REMOVE</div>
	<span>DELETE FROM articles WHERE articles.article_id = $id"?<pre style="display: inline;">    </pre>|<pre style="display: inline;">    </pre><a href="write_mySQL?query=DELETE FROM articles WHERE article_id = $id" class="editorlink">MySQL - Editor</a></span>
</div>
		
<!-------------  end[Article - Meta] | begin[Article - Content] ----------------->
<?php if (!isset($_GET["what"])){echo '<div class = "disnone">';} else {echo '<div class="main-order">';}?>
<?php if ($_GET["what"] == "content" && !isset($_POST['update_content'])){ echo '<div class = "content_wrapper">';} else {echo '<div class="disnone">';}

//gibt es den artikel?
$exist_query = 'SELECT sub_name FROM articles WHERE article_name = "'. $_GET['article_name'] .'"';
$exist_result = mysqli_query($conn, $exist_query);
if (mysqli_num_rows($exist_result) == 0){
	echo "Artikel existiert nicht.";
	echo "<div class='disnone'>";
} else {
	$sub_name = mysqli_fetch_assoc($exist_result)['sub_name'];

	//new content
	if(isset($_GET['add_new_content'])){	
		if($_GET['add_new_content'] != "Abschnitt hinzufügen"){
				//existiert content schon?
				$contentsemimain_query = "SELECT content_name FROM contents WHERE content_name = '" . $_GET['content_name'] . "' AND article_name = '" . $_GET['article_name'] . "'";
				$contentsemimainsql = mysqli_query($conn, $contentsemimain_query);

				if(mysqli_num_rows($contentsemimainsql) == 0){
					$new_content_query = "INSERT INTO `contents` (`content_id`, `article_name`, `sub_name`, `content_name`, `content_text`, `reihenfolge`) VALUES (NULL, '" . $_GET['article_name'] . "', '" . $sub_name . "', '" . $_GET['content_name'] . "', '', '');";
					mysqli_query($conn, $new_content_query);
				}
		} else {
			$new_content_query = "INSERT INTO `contents` (`content_id`, `article_name`, `sub_name`, `content_name`, `content_text`, `reihenfolge`) VALUES (NULL, '" . $_GET['article_name'] . "', '" . $sub_name . "', '" . 'Neuer Abschnitt' . "', '', '');";
			mysqli_query($conn, $new_content_query);
		}
	}

	$contentmain_query = "SELECT * FROM contents WHERE article_name = '" . $_GET['article_name'] . "' ORDER BY `reihenfolge` ASC";
	$contentmainsql = mysqli_query($conn, $contentmain_query);

	$tg_query = 'SELECT tg_name FROM subgebiete WHERE sub_name = "'. $sub_name .'"';
	$tg_result = mysqli_query($conn, $tg_query);

	$tg_name = mysqli_fetch_assoc($tg_result)['tg_name'];

	$contenturl = '<a href=../' . $tg_name . '/?' . urlencode($sub_name) . '/' . urlencode($_GET['article_name']) . '#';

	$content_top_table_rows = '';
	$i = 1;
	$content_link_array = [$contenturl . ">" . $_GET['article_name'] . "</a>"];
	$content_big_form = '';

	$contentFhtml = ['<div class="form-box">',
		'<div class="code-prev"><div class="codebox" contenteditable="true" spellcheck="true" lang="de">','</div><div class="prevbox content-box" contenteditable="true" spellcheck="true">','</div></div>

		<form class="content_form" action="articles.php?what=content&update_content=submit&article_name=' . urlencode($_GET['article_name']) . "&update_content_rf=" , "&update_content_id=" ,
				 '&update_content_name=' , '" method="post">

		<div class="flex-top"><div class="flex-top-title">Update content</div>
			<input type="submit" name="update_content" value="Submit"/>
			</div>
			<textarea name="updatecontent_value" oninput=\'this.style.height = "";this.style.height = this.scrollHeight + "px"\'></textarea>
		</form></div>'
	];

	while ($content = mysqli_fetch_assoc($contentmainsql)){
		$content_link_array[] = $contenturl . str_replace(" ","-", $content['content_name']) . "><span>" . $i . ". " . $content['content_name'] . "</span>| content_id = " . $content['content_id'] . " </a>";
		$content_top_table_rows .= '<tr><th>' . $content_link_array[$i] . "</th><th>" . $content['content_id'] . "</th></tr>";

		$latex_replaced = str_replace('$$', '[$[$]$]', $content['content_text']);
		$latex_replaced = str_replace('\\(', '[$($[', $latex_replaced);
		$latex_replaced = str_replace('\\)', ']$)$]', $latex_replaced);

		$replace_backslash = str_replace('\\\\', '\\\\\\\\', $content['content_text']);

		$content_big_form .= $contentFhtml[0] . $content_link_array[$i] . $contentFhtml[1] . nl2br(str_replace("\begin", "\<s>.</s>begin", htmlspecialchars($replace_backslash))) 
			. $contentFhtml[2] . $latex_replaced . $contentFhtml[3] . $i . $contentFhtml[4] . $content['content_id'] . $contentFhtml[5] . $content['content_name'] . $contentFhtml[6];
		$i++;
	}
}
?>

<style type="text/css">
	<?php
		//GET_STYLE
		$style_query = "SELECT article_style FROM articles WHERE article_name = '" . $_GET['article_name'] . "';";
		$style = mysqli_query($conn, $style_query);
		echo mysqli_fetch_assoc($style)['article_style'];
	?>
</style>
	
<div class="content_top_wrapper">
	<div class="inhalt_links">
		<?php
			foreach ($content_link_array as $link){echo $link;}
		?>
		<form class="form-box">
			<input type="submit" name="add_new_content" value="Abschnitt hinzufügen">
			<input type="hidden" name="what" value="content">
			<input type="hidden" name="update_content" value="content">
			<input type="hidden" name="article_name" value=<?php echo '"' . $_GET['article_name'] . '"' ?>>
		</form>
	</div>
	<div class="top_wrapper_trenn"></div>
	<div class="top_wrapper_right">
		<a href=<?php echo "order-stuff.php?where=content&order_name=" . urlencode($_GET['article_name']) . "&submit=Search"?>>Order</a>
		<a href="overview.php">Overview</a>
		<a href="write_mySQL?query=DELETE FROM contents WHERE content_id = $id">Remove</a>
	</div>
</div>

<?php echo $content_big_form?>


</div> 

<?php 
if(isset($_POST['update_content'])){
	if(isset($_GET['update_content_rf'])){
		include_once 'dev-php/update_content.php';
	}

	if($_GET['what'] == "exercises"){
		include_once 'dev-php/manipulate-article-exercises.php';
	}
}?>

</div>

<?php if(isset($_GET['what'])){
	if($_GET['what'] == "exercises" && !isset($_GET['update_aufgabe'])){
		include_once 'dev-php/manipulate-article-exercises.php';
	} elseif($_GET['what'] == "exercises" && isset($_GET['update_aufgabe'])){
		include_once 'dev-php/update_aufgabe.php';
	}
}?>


</div>


</body>
</html>