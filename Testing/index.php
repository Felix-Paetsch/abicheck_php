<?php 
	include_once '../Import/php/restrict-access.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="robots" content="noindex">
	<title>Testing</title>
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
		<a href="../Dev-tools/">Dev-Tools</a>
		<a href="../index.php">Abicheck</a>
		<a href="prototypes-articles.php">Prototypes Articles</a>
		<a href="prototypes-übungen.php">Prototypes Übungen</a>
		<a href="prototypes-rechner.php">Prototypes Rechner</a>
		<a href="testing.php">Testing</a>
	</div>
</body>
</html>