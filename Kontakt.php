<?php
	include_once 'Import/php/database.php';
	if (isset($_POST["nachricht"])){
		if ($_POST["nachricht"] !== ""){
			$sql = "INSERT INTO `kontakt` (`kontakt_id`, `kontakt_timestamp`, `name`, `email`, `text`) VALUES (NULL, current_timestamp(), ?, ?, ?); ";
			QuerySQL($sql, [$_POST['name'], $_POST['mail'], $_POST['nachricht']], "sss");

			writeToKontakt();
		}
		echo "<script>
		    	Swal.fire({
				  title: 'Nachricht gesendet!',
				  icon: 'success',
				  confirmButtonText: 'Ok'
				})
			</script>";
	}

	  function writeToKontakt(){
	  	$fp = fopen('Data/kontakt.txt', 'a');
		fwrite($fp, 
			getdatetime() . "\nE-Mail: " . $_POST['mail'] . "\nName: " . $_POST['name'] . "\nNachricht: " . $_POST['nachricht'] . "\n \n"
		);
		fclose($fp);
	  }
	 $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="icon" href="Import/bilder/webcon2.png">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<title>Kontakt</title>

	<!-- this specific -->
	<link rel="stylesheet" type="text/css" href="Import/css/searchpage.css">
	<link rel="stylesheet" type="text/css" href="Import/css/search.css">
	<style type="text/css">
		form{
			display: flex;
			flex-direction: column;
		}

		.chunk{
			display: flex;
			justify-content: space-between;
			margin: 10px 0px 10px;
		}

		label{
		}

		.chunk > *:nth-child(2){
			width: 450px;
			padding: 20px;
			box-sizing: border-box;
		}

		.kontakt-wrapper{
			margin-top: 70px;
			margin-left: 40px;
			background: rgba(255, 255, 255, 0.5);
			box-shadow: 0 1px 7px rgba(0, 0, 0, 0.2);
			padding:20px 60px 40px 60px;
		}

		textarea{
			resize: vertical;
			min-height: 200px;
		}

		.topic{
			color: #118982;
			font-size: 35px;
		}

		.chunk > input[type=submit]:nth-child(2){
			cursor: pointer;
			padding: 10px 0px;
			font-size: 16px;
			color: white;
			border: none;
			background-color: rgba(20,160,152, 1);
			transition-duration: .3s;
			transition-property: background-color;
		}

		.chunk > input[type=submit]:nth-child(2):hover{
			background-color: #118982;
		}

		form > span{
			font-size: 12px;
			display: inline-block;
			margin-top: 18px;
		}

		@media(max-width: 1100px){
			.chunk{
				flex-direction: column;
			}

			.chunk label{
				margin: 5px 0px 10px 0px;
			}

			.chunk > *:nth-child(2){
				width: unset;
			}

			.kontakt-wrapper{
				padding: 20px 40px 40px 40px;
			}
		}

		@media(max-width: 900px) and (min-width:  600px){
			.main-content{
				padding-left: 30px !important;
				padding-right: 50px !important;
			}

			.kontakt-wrapper{
				margin-top: 40px;
			}
		}
	</style>
</head>

<body>
<?php include_once "Import/php/Sheader.php"; ?>

<div class="zwischenlinie-a"></div>

<div class="left-fixed">
	<div class="left-fixed-list">
		<a class="fixed-head fixed-head-a" href="Grundlagen/..">Startseite</a>
		<div class="fixed-head fixed-head-b">Abicheck</div>
		<div class="fixed-ul">
			<a href="about">Über Abicheck</a>
			<a href="Kontakt">Kontakt</a>
			<a href="Analysis/">Impressum</a>
			<a href="Stochastik/">Datenschutz</a>
		</div>
	</div>
</div>


<div id="main-wrapper">
	<div class="main-content">
		<div class="kontakt-wrapper">
			<h2 class="topic">Kontakt</h2>
			<p class="description">
				Hier steht toller Text <3
			</p>
			<form method="POST">
				<div class="chunk">
					<label for="name">Name:<span class="star">*</span></label>
					<input type="text" name="name" placeholder="Name...">
				</div>
				<div class="chunk">
					<label for="mail">E-Mail:<span class="star">*</span></label>
					<input type="text" name="mail" placeholder="name@gmail.com">
				</div>
				<div class="chunk">
					<label for="nachricht">Nachricht<span class="star"></span>:</label>
					<textarea name="nachricht" placeholder="Deine Nachricht..."></textarea>
				</div>
				<div class="chunk">
					<span></span>
					<input type="submit" name="" value="Nachricht Abschicken">
				</div>
				<span>*Wenn du eine Antwort bekommen möchtest, gibt deinen Namen und deine E-Mail-Adresse ein.</span>
			</form>
		</div>
	</div>
	<div class="scroll-up" id="scroll-up" tilte="Nach oben">
		<div class="arrow arrow1"></div>
		<div class="arrow arrow2"></div>
	</div>
</div>
<?php include_once "Import/php/Sfooter.php"; ?>
<script>
	<?php
	if (isset($_POST["nachricht"])){
		echo "Swal.fire({
				  title: 'Nachricht gesendet!',
				  icon: 'success',
				  confirmButtonText: 'Ok'
				})";
	}
	?>

    if ( window.history.replaceState ) {
       window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>

