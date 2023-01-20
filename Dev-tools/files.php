<?php 
	//Nur ich kann zugreifen (meine IP)
	include_once '../Import/php/restrict-access.php';
	include_once '../Import/php/database.php';


	function is_test($b){
		return $b ? 'TRUE' : 'FALSE';
	}

	$get_all_files_result = QuerySQL("SELECT * FROM files");
	$all_files_table = "";
	$count = 0;
	while ($one_file = mysqli_fetch_assoc($get_all_files_result)){
		$all_files_table .= "<tr>
			<th>" . $one_file['id'] . "</th>
			<th>" . $one_file['article_name'] . "</th>
			<th>" . $one_file['sub_name'] . "</th>
			<th>" . $one_file['file_name'] . "</th>
			<th>" . is_test($one_file['is_test']) . "</th>
			<th>" . htmlspecialchars($one_file['file_link']) . "</th>
		</tr>";
		$count++;
	}

	if(isset($_GET['article_name'])){
			$article_name = $_GET['article_name'];
			$exist_result = QuerySQL("SELECT sub_name FROM articles WHERE article_name = ?", [$article_name], "s");
			$exist_bool = mysqli_num_rows($exist_result) == 1 ?  1 : 0;
	}	else {
		$exist_bool = 3;
		$article_name = "kein artikel ausgewählt";
	} 
?>


<!DOCTYPE html>
<html>
<head>
	<title>Files</title>
	<link href="https://fonts.googleapis.com/css2?family=MuseoModerno&display=swap" rel="stylesheet"> <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
	<!--MATH JAX-->
	<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
	<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<?php include_once "ScriptIncludeStuff.php" ?>
	<link rel="stylesheet" type="text/css" href="../Import/css/tools.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/übungen.css">
	<script type="text/javascript" src="../Import/js/canvas2.js"></script>

	<style type="text/css">
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
			margin-left: 100px;
		}

		.submit_new:hover{
			background: #187bcd;
			color: white !important;
			transition-duration: .3s;
		}

		.article_form{
			margin-top: 40px;
			margin-bottom: 30px;
			display: flex;
			flex-direction: row;
		}

		.name{
			margin-left: 0px;
		}

		.name input{
			height: 40px;
			margin-left: 20px;
			margin-right: 30px;
			width: 300px;
		}

		.article_form div:nth-child(2) input{
			margin-left: 20px;
			width: 300px;
			font-family: 'MuseoModerno', cursive;
			font-size: 18px;
			padding-left: 10px;
		}

		.article_form label{
			font-size: 25px;
		}

		.article_form div{
			display: flex;
			flex-direction: row;
		}

		table.übersicht{
			margin-top: 200px;
		}

		table tr th{
			padding-right: 40px;
			padding-bottom: 20px;
		}

		input[name=article_name]{
			font-size: 18px;
			box-sizing: border-box;
			padding-left: 5px;
		}
</style>
</head>
<body>
	<div class="main">
		<a class ="zurück" href="index.php">Zurück</a>
		<span class="topbar"></span>
		<span class="top">Files</span>
		<span class="topbar"></span>
		<span class="top" style="color: #187bcd;">Amount: <?php echo $count;?></span>
		<div class="line line1"></div>


		<form class="article_form">
			<div class="name">
				<label for="article_name">Search files for:</label><br>
				<input type="text" name="article_name">
			</div>
			<div>
				<input class="submit_new" type="submit" name="submit" value="Search"/>
			</div>
		</form>

		<?php
			if($exist_bool == 1){
				include_once "dev-php/import_files.php";
			} else if($exist_bool == 0) {echo "<div class='ex_nicht'>Artikel '" . $article_name . "' existiert nicht.";}		
		?>

		<table class="übersicht">
			<tr>
				<th>id</th>
				<th>article_name</th>
				<th>sub_name</th>
				<th>file_name</th>
				<th>is_test</th>
				<th>file_link</th>
			</tr>
			<?php echo $all_files_table ?>
		</table>




	</div>
</body>
