<?php 
	include_once '../Import/php/restrict-access.php';
?>

<!DOCTYPE html>
<html>
<head>
	<?php include_once "../dev-tools/ScriptIncludeStuff.php" ?>
	<title>Data</title>
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
		<a href="../Dev-tools/">Dev-tools</a>
		<a href="../Testing/">Testing</a>
		<a href="recover.php">Recover</a>
		<a href="feedback.php">View Feedback</a>
		<a href="kontakt.php">Kontakt</a>
		<a href="manageErrors.php">Error Log</a>
		<a href="userdata.php">Userdata</a>
	</div>
</body>
</html>