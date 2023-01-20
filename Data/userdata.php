<?php 
	include_once '../Import/php/restrict-access.php';
	//probably would wont a "cronjob" -> time dependent execute stuff / every month
	include_once 'Dev-php/userdatafunctions.php';
?>


<!DOCTYPE html>
<html>
<head>
	<?php include_once "../dev-tools/ScriptIncludeStuff.php" ?>
	<title>Kontakt</title>

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

		.nachrichten{
			margin: 40px 0px 0px 20px;
		}

		.nachrichten > div{
			margin: 20px 0px 60px 0px;
		}

		.nachrichten div div{
			display: flex;
			flex-direction: row;
		}

		.nachrichten div div:nth-child(4){
			margin-top: 10px;
		}

		.nachrichten span{
			display: block;
		}

		.nachrichten div span:nth-child(1){
			width: 200px;
			color: #4ecba5;
		}

		.nachrichten div span:nth-child(2){
			max-width: 800px;
		}
	</style>
</head>

<body>
	<div class="main">
		<a class ="zurück" href="index.php">Zurück</a>
		<span class="topbar"></span>
		<span class="top">Userdata</span>
		<span class="topbar"></span>
		<span class="top" style="color: #187bcd;">Abicheck</span>
		<div class="line line1"></div>
		<div class="functions">
			$dataset = new Dataset("userdata.txt");<br>
			TotalPageViews(); : int<br>
			MostVisitedPages(); : Array[$url, $count, $prozent]<br>
			UniqueUsers(); : int<br>
			PageViewsPerDatatimeString(); : Array[$datatime, $count]
		</div>
	</div>

</body>
</html>