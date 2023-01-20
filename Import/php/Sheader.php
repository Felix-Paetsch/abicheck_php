<?php
	try{
		$date = new DateTime();
		$timestamp = $date->getTimestamp();
		$ip_adress = $_SERVER['REMOTE_ADDR'];
		$url = str_replace("\n", "[NEW_LINE]", urldecode($_SERVER['REQUEST_URI']));
		$UserData = "TST: " . $timestamp . "\nIPA: " . $ip_adress . "\nURL: " . $url;
		writeToUserData($UserData);
	}catch(exception $e){writeToUserData("Exception: " . $e);}

	function writeToUserData($UserData){
	  	$fp = fopen('Data/userdata.txt', 'a');
		fwrite($fp, $UserData . "\n");
		fclose($fp);
	}
?>
	<link href="https://fonts.googleapis.com/css?family=Gelasio|Roboto&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 

	<link rel="stylesheet" type="text/css" href="Import/css/header.css">
	<link rel="stylesheet" type="text/css" href="Import/css/allgemeinformat.css">
	<link rel="stylesheet" type="text/css" href="Import/css/allgemeintop+fixed-format.css">
	<link rel="stylesheet" type="text/css" href="Import/css/header.css">
	<link rel="stylesheet" type="text/css" href="Import/css/footer.css">
	<link rel="stylesheet" type="text/css" href="Import/css/scrollup.css">
	<link rel="stylesheet" type="text/css" href="Import/css/main-content-widht.css">

<!--js tools-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--scroll up-->
	<script type="text/javascript" src="Import/js/scrollup.js"></script>
	<script type="text/javascript" src="Import/js/changeclass.js"></script>

<div id="nav2"> 
	<div class="navtop"> 
		<a href="Grundlagen/.." class="logo-area"> 
			<div class="logo-img"></div> 
			<div class="logo-name">Abicheck</div> 
		</a> 

		<div class="navtop-rechts">
			<a href="Prüfungen">Prüfungen</a>
			<div class="trenn"></div>
			<a href="Rechner">Rechner</a>
		</div>
	</div> 
	<div class="zwischenlinie-b"></div> 
</div> 

<div class="zwischenlinie-a"></div>