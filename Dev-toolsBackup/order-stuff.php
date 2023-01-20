<?php 
	//Nur ich kann zugreifen (meine IP)
	include_once '../Import/php/restrict-access.php';
	include_once '../Import/php/database.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>Order Stuff</title>
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

		.to_order{
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

		.to_order div:nth-child(2) input{
			margin-left: 20px;
			width: 300px;
			font-family: 'MuseoModerno', cursive;
			font-size: 18px;
			padding-left: 10px;
		}

		.to_order label{
			font-size: 25px;
		}

		.to_order div{
			display: flex;
			flex-direction: row;
		}

		.to_order select{
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
			margin-left: 100px;
		}

		.submit_new:hover{
			background: #187bcd;
			color: white !important;
			transition-duration: .3s;
		}

		.disnone{
			display: none;
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
	</style>
</head>
<body>
	<div class="main">
		<a class ="zurück" href="../Dev-tools">Zurück</a>
		<span class="topbar"></span>
		<span class="top">Order Stuff</span>
		<span class="topbar"></span>
		<span class="top" style="color: #187bcd;">Foli</span>
		<div class="line line1"></div>

		<form class="to_order" action="order-stuff.php">
			<div>
				<label for="where">What to order:</label><br>
				<select name="where" class="classic">
					<option value="articles">Sub -> Articles</option>
					<option value="content">Article -> Contents</option>
					<option value="ex">Article -> Exercises</option>
				</select> 
			</div>
			<div class="name">
				<label for="order_name">Name:</label><br>
				<input type="text" name="order_name">
			</div>
			<div>
				<input class="submit_new" type="submit" name="submit" value="Search"/>
			</div>
		</form>

<?php if (!isset($_GET["submit"])){ echo '<div class = "disnone">';} else {echo '<div class="main-order">';}

if($_GET['where'] == 'articles'){
	$where = 'articles';
	$rhf = 'reihenfolge';
	$id_type = 'article_id';

	$gettable_query = "SELECT article_id, article_name, reihenfolge FROM " . $where . " WHERE sub_name = '" . $_GET['order_name'] . "' ORDER BY " . $rhf . " ASC";
	$querytype = "A";
} elseif($_GET['where'] == 'content'){
	$where = 'contents';
	$rhf = 'reihenfolge';
	$id_type = 'content_id';

	$gettable_query = "SELECT content_id, content_name, sub_name, reihenfolge FROM " . $where . " WHERE article_name = '" . $_GET['order_name'] . "' ORDER BY " . $rhf . " ASC";
	$querytype = "B";
} elseif($_GET['where'] == 'ex'){
	$where = 'exercises';
	$rhf = 'ex_reihenfolge';
	$id_type = 'ex_id';

	$gettable_query = "SELECT ex_id, ex_aufgabe, ex_reihenfolge FROM " . $where . " WHERE article_name = '" . $_GET['order_name'] . "' ORDER BY " . $rhf . " ASC";
	$querytype = "C";
} else{ echo 'no query selected ERROR';};

$result = mysqli_query($conn, $gettable_query);

//update id
$elements_num = mysqli_num_rows($result);

	if(isset($_GET['update_go'])){
		for($i = 1; $i <= $elements_num; $i++){
			$update_query = "UPDATE " . $where . " SET " . $rhf . " = " . $i . " WHERE " . $id_type . " = '" . $_GET['rhf' . $i] . "'";
			$return = mysqli_query($conn, $update_query);
		}
	}

$result = mysqli_query($conn, $gettable_query);

if (mysqli_num_rows($result) == 0){
	echo "Keine Ergebnisse ...";
	echo '<div class = "disnone">';
} else {
	echo '<div class = "result">';
}

?>
	<div class="first-row">
		<div>To order: 
<?php $name = $_GET["order_name"]; 
	if($querytype == "C"){$name .= " - Übungen";}
	echo $name;
?>

	</div>
		<span class="trenn">|</span>
		<div class="show_link">
<?php
	if ($querytype == "A"){
		$gebiet_query = "SELECT tg_name FROM subgebiete WHERE sub_name = '" . $_GET['order_name'] . "'";
		$gebiet = mysqli_query($conn, $gebiet_query);
		$gebiet_name = mysqli_fetch_assoc($gebiet)['tg_name'];
		echo '<a href = " ' . '../' . $gebiet_name . ' ">/' . $gebiet_name . '</a> ';
	} elseif ($querytype == "B"){
		$gebiet_query = "SELECT sub_name FROM contents WHERE article_name = '" . $_GET['order_name'] . "'";
		$gebiet = mysqli_query($conn, $gebiet_query);
		$gebiet_name = mysqli_fetch_assoc($gebiet)['sub_name'];

		$tg_query = "SELECT tg_name FROM subgebiete WHERE sub_name = '" . $gebiet_name . "'";
		$tg = mysqli_query($conn, $tg_query);
		$tg_name = mysqli_fetch_assoc($tg)['tg_name'];

		$link = '/' . $tg_name . '/?' . $gebiet_name . "/" . $_GET['order_name'];
		echo '<a href = " ' . '..' . $link . ' ">' . $link . '</a> ';
	} else{
		$gebiet_query = "SELECT sub_name FROM contents WHERE article_name = '" . $_GET['order_name'] . "'";
		$gebiet = mysqli_query($conn, $gebiet_query);
		$gebiet_name = mysqli_fetch_assoc($gebiet)['sub_name'];

		$tg_query = "SELECT tg_name FROM subgebiete WHERE sub_name = '" . $gebiet_name . "'";
		$tg = mysqli_query($conn, $tg_query);
		$tg_name = mysqli_fetch_assoc($tg)['tg_name'];

		$link = '/' . $tg_name . '/?' . $gebiet_name . "/" . $_GET['order_name'] . '-Übungen';
		echo '<a href = " ' . '..' . $link . ' ">' . $link . '</a> ';
	}
?>
		</div>
	</div>

	<div class="float">

	<table>
	 	<tr>
	 		<th>ID</th>
	    	<th>NAME / CONTENT</th>
	    	<th>ORDER</th>
	 	</tr>

<?php 
	$echorow = "";

	while ($row = mysqli_fetch_assoc($result)) {
		if ($querytype == "A"){
			$echoid = $row['article_id'];
			$echoname = $row['article_name'];
			$echo_rhf = $row['reihenfolge'];
		} elseif ($querytype == "B"){
			$echoid = $row['content_id'];
			$echoname = $row['content_name'];
			$echo_rhf = $row['reihenfolge'];
		} else {
			$echoid = $row['ex_id'];
			$echoname = $row['ex_aufgabe'];
			$echo_rhf = $row['ex_reihenfolge'];
		}
			$echorow .= '<tr><th>' . $echoid. "</th>";
			$echorow .= '<th>' . $echoname . "</th>";
			$echorow .= '<th>' . $echo_rhf . "</th></tr>";
	}
	echo $echorow;
?>
	</table>

	<form class="set_order" action="order-stuff.php">

<?php
	for($i = 1; $i <= $elements_num; $i++){
		echo '
			<div><label for="rhf' . $i . '">' . $i . '. Element (Id):</label><br>
			<input type="number" name="rhf' . $i . '"></div>';
	}
?>
		<input class="submit_rhf submit_new" type="submit" name="update_go" value="submit"/>
		<input type="hidden" name="where" value=<?php  echo '"' . $_GET['where'] . '"'?>>
		<input type="hidden" name="order_name" value=<?php  echo '"' . $_GET['order_name'] . '"'?>>
		<input type="hidden" name="submit" value ="Search" value=<?php  echo '"' . $_GET['submit'] . '"'?>>
	</form>
	</div>

	<div class="remove">
		<div class="top_name">REMOVE</div>
		<span>DELETE FROM <?php echo $where ?> WHERE <?php echo $id_type ?> = $id<pre style="display: inline;">    </pre>|<pre style="display: inline;">    </pre>
			<a <?php echo 'href="write_mySQL?query=' . 'DELETE FROM ' . $where . ' WHERE ' . $id_type . ' = $id "' ;?>class="editorlink">MySQL - Editor</a></span>
	</div>

	</div>
	</div>
	</div>

</body>
</html>