<?php 
	//Nur ich kann zugreifen (meine IP)
	include_once '../Import/php/restrict-access.php';
	include_once '../Import/php/database.php';

	if (isset($_GET['new_rechner'])){
		$insert_query = "INSERT INTO `rechner` (`rechner_id`, `rechner_name`, `article_name`, `import_filesJsCss_AndMeta`, `rechner_input`, `rechner_output`, `ref_link`, `JSscript`, `import_filesPHP`) VALUES (NULL, '', '', '', '', '', '', '', '');";
		SaveQuerySQL($insert_query);

		$max_id = mysqli_fetch_assoc(QuerySQL('SELECT MAX(rechner_id) AS "max_id" FROM rechner;'))['max_id'];
		header('Location: rechner.php?rechner_id=' . $max_id);
	}

	$rechner = QuerySQL("SELECT * FROM rechner ORDER BY rechner_id DESC");
	$row_num1 = mysqli_num_rows($rechner);

	$echo_rechner = '';
	while ($r = mysqli_fetch_assoc($rechner)) {
		$echo_rechner .= '<tr>';
		$echo_rechner .= '<th>'. htmlspecialchars($r['rechner_id']) . '</th>';
		$echo_rechner .= '<th>'. htmlspecialchars($r['rechner_name']) . '</th>';
		$echo_rechner .= '<th>'. htmlspecialchars($r['article_name']) . '</th>';
		$echo_rechner .= '<th>'. '<form artion="rechner.php"><input type="hidden" name="rechner_id" value="' . $r['rechner_id'] . '"><input type="submit" value="Update" class="unc_btn"></form>' . '</th>';
		$echo_rechner .= '</tr>';
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Rechner</title>
	<link href="https://fonts.googleapis.com/css2?family=MuseoModerno&display=swap" rel="stylesheet"> <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
<?php include_once "ScriptIncludeStuff.php" ?>
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

		.disnone{
			display: none;
		}

		.label{
			margin-top: 50px;
			font-size: 40px;
			display: flex;
			flex-direction: row;
			cursor: pointer;
		}

		.label .arrows{
			display: flex;
			flex-direction: row;
			margin-left: 10px;
			margin-top: 17px;
		}

		.label .arrows div{
			width: 25px;
			height: 25px;
			border-left: 4px white solid;
			border-top: 4px white solid;
			transform: rotate(135deg);
		}

		.label .arrows div:nth-child(2){
			margin-left: -15px;
		}

		.label:hover{
			color: rgb(200,200,200);
			transition-duration: .3s;
		}

		.label:hover .arrows div{
			color: rgb(200,200,200);
			transition-duration: .3s;
			border-color: rgb(200,200,200);
		}

		.labelwr{
			width: 600px;
			display: flex;
			flex-direction: row;
		}

		.active .arrows{
			transform: rotate(90deg);
			margin-top: -15px;
			margin-left: -10px;
		}

		.amount{
			color: #187bcd;
		}

		table{
			margin-top: 80px;
			text-align: left;
			font-family: 'Roboto', sans-serif;
		}

		table tr th:nth-child(1){
			width: 100px;
		}

		table tr th:nth-child(2){
			width: 400px;
		}

		table tr th:nth-child(3){
			width: 400px;
		}

		table tr th:nth-child(4){
			width: 400px;
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

		.add form, .update form{
			display: flex;
			flex-direction: row;
		}

		.show_tg .add form div:nth-child(1) textarea {width: 170px;}
		.show_tg .add form div:nth-child(2) textarea {width: 400px;}
		.show_tg .add form div:nth-child(3) textarea {width: 210px;}
		.show_tg .add form div:nth-child(4) textarea {width: 200px;}

		.show_tg .update form div:nth-child(1) textarea {width: 70px;}
		.show_tg .update form div:nth-child(2) textarea {width: 170px;}
		.show_tg .update form div:nth-child(3) textarea {width: 400px;}
		.show_tg .update form div:nth-child(4) textarea {width: 210px;}
		.show_tg .update form div:nth-child(5) textarea {width: 200px;}

		.add div , .update div{
			margin-right: 20px;
		}

		.submit_new{
			background: unset;
			border-radius: 30px;
			font-weight: inherit;
			font-size: inherit;
			font-family: inherit;
			padding: 5px 10px 5px 10px;
			min-width: 150px;
			margin-top: 35px;
		}

		.add .submit_new{
			margin-left: 95px;
			border-color: #187bcd;
			color: #187bcd;
		}

		.add_sub .submit_new{
			margin-left: 200px;
		}

		.tg_go{
			border: 2px solid #4ecba5;
			color: #4ecba5;
		}

		.tg_go:hover{
			background: #4ecba5;
			color: white !important;
			transition-duration: .3s;
		}

		.add .tg_go:hover{
			background: #187bcd;
		}

		.top_name{
			margin-top: 40px;
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

		input[type = submit]{
			background: unset;
			border-radius: 30px;
			font-weight: inherit;
			font-family: inherit;
			padding: 5px 10px 5px 10px;
			min-width: 150px;
		}

		.unc_btn{
			border: 2px solid #4ecba5;
			color: #4ecba5;
		}

		.unc_btn:hover{
			background: #4ecba5;
			color: white;
		}

		.c_btn{
			border: 2px solid #187bcd;
			color: #187bcd;
			margin: 30px 0px 20px 0px;
			font-size: 22px;
		}

		.c_btn:hover{
			background: #187bcd;
			color: white;
		}

	</style>
	<script type="text/javascript" src="../Import/js/changeclass.js"></script>
</head>
<body>
	<div class="main">
		<a class ="zurück" href="index.php">Zurück</a>
		<span class="topbar"></span>
		<span class="top">Rechner</span>
		<div class="line line1"></div>
		<form>
			<input type="submit" name="new_rechner" value="Neuen Rechner Hinzufügen" class="c_btn">
		</form>
		<?php
			if(!isset($_GET['rechner_id']) && !isset($_GET['new_rechner'])){
				include_once "dev-php/rechner_overview.php";
			} elseif(isset($_GET['rechner_id'])){
				include_once "dev-php/update_rechner.php";
			}
		?>
	</div>
</body>
</html>