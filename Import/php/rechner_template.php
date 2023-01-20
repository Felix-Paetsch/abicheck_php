<?php
	$rechnerData = mysqli_fetch_assoc($is_rechner);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="icon" href="../Import/bilder/webcon2.png">
	<title><?php echo $rechner;?></title>
	<link rel="stylesheet" type="text/css" href="../Import/css/rechner.css">
	<?php echo $rechnerData['import_filesJsCss_AndMeta'];?>
</head>
<body>
	<?php 
		include_once '../Import/php/header.php'; 
		if($rechnerData['import_filesPHP'] != ""){include_once $rechnerData['import_filesPHP'];}
	?>

	<div class="left-fixed">
	<div class="left-fixed-list">
		<a class="fixed-head fixed-head-a" href="../">Startseite</a>
		<div class="fixed-head fixed-head-b">Themengebiete</div>
		<div class="fixed-ul">
			<a href="../Grundlagen/">Grundlagen</a>
			<a href="../Geometrie/">Geometrie</a>
			<a href="../Analysis/">Analysis</a>
			<a href="../Stochastik/">Stochastik</a>
		</div>
	</div>
</div>

<div id="main-wrapper">
	<div class="main-content">
		<h3 class="title"><?php echo $rechner ?></h3>
		<?php echo $rechnerData['rechner_input'] ?>
		<div class="ergebnis disnone">
			<?php echo $rechnerData['rechner_output'] ?>
		</div>
		<div class="stylelinie2"></div>
		<div class="expl-link">
			<?php echo $rechnerData['ref_link'] ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php echo $rechnerData['JSscript'] ?>
</script>

<?php 
	include_once 'feedback.php';
	include_once '../Import/php/footer.php'; 
?>
</body>
</html>