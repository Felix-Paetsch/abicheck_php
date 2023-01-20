<?php 
	include_once '../Import/php/restrict-access.php';
	include_once '../Import/php/database.php';

	if (isset($_GET['run_query'])){
		$result = mysqli_query($conn, $_GET['run_query']);
		$rows_affected = mysqli_affected_rows($conn);
		if($rows_affected > 0) insertDirectSQLQuery($_GET['run_query']);

		$sql = "INSERT INTO `querys` (`id`, `query`, `rows_affected`, `timestamp`) VALUES (NULL, ?, ?, current_timestamp());";
		SaveQuerySQL($sql,[$_GET['run_query'], $rows_affected], "si");
	}

	$insert_query = "";
	$query_result = QuerySQL("SELECT * FROM querys ORDER BY id DESC;");

	while($query = mysqli_fetch_assoc($query_result)){
		$insert_query .= '<tr><th>' . $query['id'] . '</th><th>' . $query['query'] . '</th><th>' . $query['rows_affected'] . '</th><th>' . $query['timestamp'] . '</th></tr>';
	}

	$conn->close();

	function insertDirectSQLQuery($newQuery){
		$backupfile = file_exists('../Data/backup.txt') ? '../Data/backup.txt' : (file_exists('Data/backup.txt') ? 'Data/backup.txt' : '../../Data/backup.txt');
		$newQuery = semicolonAtEnd($newQuery);
		file_put_contents($backupfile, "\n" . getdatetime() . "\n" . $newQuery, FILE_APPEND | LOCK_EX);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once "ScriptIncludeStuff.php" ?>
	<title>mySQL Editor</title>
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

		.top-text{
			font-size: 30px;
			margin: 30px 0px 10px 0px;
		}

		textarea{
			width: 1400px;
		}

		input[name="query_go"]{
			background: unset;
			border-radius: 30px;
			font-weight: inherit;
			font-size: 20px;
			font-family: inherit;
			padding: 5px 10px 5px 10px;
			min-width: 150px;
			border: 2px solid #187bcd;
			color: #187bcd;
			margin-top: 20px;
			width: 300px;
		}

		input[name="query_go"]:hover{
			background: #187bcd;
			color: white !important;
			transition-duration: .3s;
		}

		table{
			margin-top: 40px;
		}

		table tr th{
			padding-right: 40px;
			text-align: left;
		}

		table tr th:nth-child(2){
			width: 900px;
		}
</style>
</head>

<body>
	<div class="main">
		<a class ="zurück" href="index.php">Zurück</a>
		<span class="topbar"></span>
		<span class="top">MySQL Editor</span>
		<div class="line line1"></div>
		<?php
			if(isset($result)) echo $result == true ? "<div class='suc'>Successful query</div>" : "<div class='nsuc'>Not Successful query</div>";
		?>
		<div class="top-text">Gibt deine MySQL Query ein:</div>
		<form>
			<textarea name="run_query" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'><?php 
				echo isset($_GET['query']) ? $_GET['query'] . ' LIMIT 1' : 'LIMIT 1'; 
			?></textarea>
			<input type="submit" name="query_go" value="Submit Query">
		</form>
		<table>
			<tr>
				<th>ID</th>
				<th>QUERY</th>
				<th>ROWS_AFFECTED</th>
				<th>TIMESTAMP</th>
			</tr>
<?php
	echo $insert_query;
?>
		</table>
	</div>

</body>
</html>