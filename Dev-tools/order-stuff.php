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
		<a class ="zurück" href="index.php">Zurück</a>
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

<?php

if(isset($_GET["submit"])) include_once "dev-php/order-stuff-main-order.php";

?>

</body>
</html>