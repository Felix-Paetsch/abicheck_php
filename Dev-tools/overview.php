<?php 
	//Nur ich kann zugreifen (meine IP)
	include_once '../Import/php/restrict-access.php';
	include_once '../Import/php/database.php';

	$tables = QuerySQL("SELECT INFORMATION_SCHEMA.TABLES.TABLE_NAME, INFORMATION_SCHEMA.TABLES.TABLE_ROWS FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'abicheck'");
	$options = "";

	while ($table = mysqli_fetch_assoc($tables)){
		if(isset($_GET['display'])){ 
			if ($_GET['display'] == $table['TABLE_NAME']){
				$options .= '<option value="' . $table['TABLE_NAME'] . '" selected="selected">' . $table['TABLE_NAME'] . '</option>';
			} else {
				$options .= '<option value="' . $table['TABLE_NAME'] . '">' . $table['TABLE_NAME'] . '</option>';
			}
		} else $options .= '<option value="' . $table['TABLE_NAME'] . '">' . $table['TABLE_NAME'] . '</option>';
	}
?>


<!DOCTYPE html>
<html>
<head>
	<?php include_once "ScriptIncludeStuff.php" ?>
	<title>Overview</title>
	<link href="https://fonts.googleapis.com/css2?family=MuseoModerno&display=swap" rel="stylesheet"> <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 

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

		.to_order{
			margin-top: 20px;
			display: flex;
			flex-direction: row;
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

</style>
</head>

<body>
	<div class="main">
		<a class ="zurück" href="index.php">Zurück</a>
		<span class="topbar"></span>
		<span class="top">Overview</span>
		<div class="line line1"></div>

		<form class="to_order">
			<div>
				<label for="display">What are you looking for?</label><br>
				<select name="display" class="classic">
<?php
	echo $options;
?>
				</select> 
			</div>
			<div>
				<input class="submit_new" type="submit" name="submit" value="View"/>
			</div>
		</form>
<?php
	if(isset($_GET['display']))  include_once 'dev-php/overview-import.php';
?>
	</div>

</body>
</html>