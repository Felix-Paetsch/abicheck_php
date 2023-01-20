<?php 
	//Nur ich kann zugreifen (meine IP)
	include_once '../Import/php/restrict-access.php';
	include_once '../Import/php/database.php';

	$all_error_urls = QuerySQL("SELECT DISTINCT error_url FROM error_log WHERE UNIX_TIMESTAMP(error_timestamp) > UNIX_TIMESTAMP(NOW()) - 2419200 ");
	$errorArray = [];

	while ($error = mysqli_fetch_assoc($all_error_urls)['error_url']){
		$error_sql = "SELECT COUNT(*), error_type FROM `error_log` WHERE error_url = ? AND UNIX_TIMESTAMP(error_timestamp) > UNIX_TIMESTAMP(NOW()) - 2419200 ";
		$errorResult = mysqli_fetch_assoc(QuerySQL($error_sql, [$error], "s"));
		$errorArray[] = [$errorResult['COUNT(*)'], $error, $errorResult['error_type']];
	}
	$error_sum = 0;
	$sortedbyvalue = [];
	foreach ($errorArray as $subarray) $error_sum += $subarray[0];
	foreach ($errorArray as $value => $subarray) $sortedbyvalue[] = $subarray[0]/$error_sum;
	asort($sortedbyvalue);
	$conn->close();

	$echo_error_html = "";
	foreach ($sortedbyvalue as $key => $value) {
		$echo_error_html = "<div><div><span>Prozentsatz: </span><span>" . round($value * 100, 1) 
							. "%</span></div><div><span>Count: </span><span>" . $errorArray[$key][0] . "</span></div><div><span>Error_URL: </span><span>" . $errorArray[$key][1] . "</span></div><div><span>Error_Type: </span><span>" .  $errorArray[$key][2] . "</span></div></div>" . $echo_error_html;
	}
?>


<!DOCTYPE html>
<html>
<head>
	<?php include_once "../dev-tools/ScriptIncludeStuff.php" ?>
	<title>Error Log</title>

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

		.fehler{
			margin: 40px 0px 0px 20px;
		}

		.fehler > div{
			margin: 20px 0px 60px 0px;
		}

		.fehler div div{
			display: flex;
			flex-direction: row;
		}

		.fehler span{
			display: block;
		}

		.fehler div span:nth-child(1){
			width: 200px;
			color: #4ecba5;
		}

		.fehler div span:nth-child(2){
			max-width: 800px;
		}
	</style>
</head>

<body>
	<div class="main">
		<a class ="zurück" href="index.php">Zurück</a>
		<span class="topbar"></span>
		<span class="top">Error Log</span>
		<span class="topbar"></span>
		<span class="top" style="color: #187bcd;">Highest: <?php echo round(end($sortedbyvalue)*100, 1)?>%</span>
		<div class="line line1"></div>

		<div class="fehler">
			<?php echo $echo_error_html; ?>
		</div>

	</div>

</body>
</html>