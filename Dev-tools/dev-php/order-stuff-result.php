<div class = "result">
	<div class="first-row">
		<div>To order: 
<?php $name = $_GET["order_name"]; 
	if($querytype == "C"){$name .= " - Übungen";}
	echo $name;
?>

	</div>
		<span class="trenn">|</span>
		<div class="show_link">
<?php
	if ($querytype == "A"){
		$gebiet_query = "SELECT tg_name FROM subgebiete WHERE sub_name = '" . $_GET['order_name'] . "'";
		$gebiet = mysqli_query($conn, $gebiet_query);
		$gebiet_name = mysqli_fetch_assoc($gebiet)['tg_name'];
		echo '<a href = " ' . '../' . $gebiet_name . ' ">/' . $gebiet_name . '</a> ';
	} elseif ($querytype == "B"){
		$gebiet_query = "SELECT sub_name FROM contents WHERE article_name = '" . $_GET['order_name'] . "'";
		$gebiet = mysqli_query($conn, $gebiet_query);
		$gebiet_name = mysqli_fetch_assoc($gebiet)['sub_name'];

		$tg_query = "SELECT tg_name FROM subgebiete WHERE sub_name = '" . $gebiet_name . "'";
		$tg = mysqli_query($conn, $tg_query);
		$tg_name = mysqli_fetch_assoc($tg)['tg_name'];

		$link = '/' . $tg_name . '/?' . $gebiet_name . "/" . $_GET['order_name'];
		echo '<a href = " ' . '..' . $link . ' ">' . $link . '</a> ';
	} else{
		$gebiet_query = "SELECT sub_name FROM contents WHERE article_name = '" . $_GET['order_name'] . "'";
		$gebiet = mysqli_query($conn, $gebiet_query);
		$gebiet_name = mysqli_fetch_assoc($gebiet)['sub_name'];

		$tg_query = "SELECT tg_name FROM subgebiete WHERE sub_name = '" . $gebiet_name . "'";
		$tg = mysqli_query($conn, $tg_query);
		$tg_name = mysqli_fetch_assoc($tg)['tg_name'];

		$link = '/' . $tg_name . '/?' . $gebiet_name . "/" . $_GET['order_name'] . '-Übungen';
		echo '<a href = " ' . '..' . $link . ' ">' . $link . '</a> ';
	}
?>
	
</div>
