<?php 
	include_once '../Import/php/restrict-access.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>DEV_MAIN</title>
<?php include_once "ScriptIncludeStuff.php" ?>
	<style type="text/css">
		body{
			background-color: #22232a;
			padding: 0px;
			margin:0px;
		}

		.links{
			height: 100vh;
			width: 100vw;
			padding-left: 50px;
			box-sizing: border-box;
			display: flex;
			flex-direction: column;
			justify-content: center;
			font-family: 'MuseoModerno', cursive;
		}

		a{
			font-size: 50px;
			color: white;
			text-decoration-line: none;
		}

		a:hover{
			color: rgb(200,200,200);
			transition-duration: .3s;
		}
	</style>
</head>
<body>
	<div class="links">
		<a href="../Data/">Data</a>
		<a href="../Testing/">Testing</a>
		<a href="view-feedback.php">View Feedback</a>
		<a href="add-remove-update.php">Add, remove, update</a>
		<a href="order-stuff.php">Order Stuff</a>
		<a href="articles.php">Articles</a>
		<a href="files.php">Files</a>
		<a href="rechner.php">Rechner</a>
		<a href="overview.php">Overview</a>
		<a href="write_mySQL.php">MySQL Editor</a>
	</div>
</body>
</html>