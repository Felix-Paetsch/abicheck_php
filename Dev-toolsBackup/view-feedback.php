<?php 
	//Nur ich kann zugreifen (meine IP)
	include_once '../Import/php/restrict-access.php';
	include_once '../Import/php/database.php';
?>


<!DOCTYPE html>
<html>
<head>
	<?php include_once "ScriptIncludeStuff.php" ?>
	<title>VIEW FEEDBACK</title>

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


		table{
			margin-top: 80px;
			text-align: left;
			font-family: 'Roboto', sans-serif;
		}

		table tr th:nth-child(1){
			width: 100px;
		}

		table tr th:nth-child(2){
			width: 200px;
		}

		table tr th:nth-child(3){
			width: 200px;
		}

		table tr th:nth-child(4){
			width: 400px;
		}

		table tr th:nth-child(5){
			width: 200px;
		}

		table tr th{
			padding-top: 10px;
			padding-right: 10px;
		}

		table tr{
			padding-right: 10px;
		}

		table tr:nth-child(1) th{
			padding-bottom: 20px;
		}

		form{
			font-weight: inherit;
			font-size: inherit;
			font-family: inherit;
		}

		input{
			background: unset;
			border-radius: 30px;
			font-weight: inherit;
			font-size: inherit;
			font-family: inherit;
			padding: 5px 10px 5px 10px;
			min-width: 150px;
		}

		.unc_btn{
			border: 2px solid #4ecba5;
			color: #4ecba5;
		}

		.unc_btn:hover{
			background: #4ecba5;
		}

		.c_btn{
			border: 2px solid #187bcd;
			color: #187bcd;
		}

		.c_btn:hover{
			background: #187bcd;
		}

		input:hover{
			color: white;
			transition-duration: .3s;
		}
	</style>
</head>

<?php
	$unchecked_query = "SELECT * FROM feedback  WHERE fb_checked = 'false';";
	$unchecked = mysqli_query($conn, $unchecked_query);
	$row_num1 = mysqli_num_rows($unchecked);

	$checked_query = "SELECT * FROM feedback  WHERE fb_checked = '1' ORDER BY fb_check_time desc;";
	$checked = mysqli_query($conn, $checked_query);
	$row_num2 = mysqli_num_rows($checked);
?>


<body>
	<div class="main">
		<a class ="zurück" href="../Dev-tools">Zurück</a>
		<span class="topbar"></span>
		<span class="top">Feedback</span>
		<span class="topbar"></span>
		<span class="top" style="color: #187bcd;">Unchecked: <?php echo $row_num1;?></span>
		<div class="line line1"></div>

		<div class="unchecked">
			 <table>
			 	<tr>
			    	<th>ID</th>
			    	<th>TIME</th>
			    	<th>ARTICLE</th>
			    	<th>TEXT</th>
			    	<th>DONE?</th>
			 	</tr>
				
<?php
	$button = ['
		<form action="dev-php/check-fb.php" method="post">
		   <input class="unc_btn" type="submit" name="','" value="done"/>
		</form>
	'];

	$echo = '';

	for ($i = 1; $i <= 20; $i++) {
		if ($row_num1 > 0){
			$tr = mysqli_fetch_assoc($unchecked);
			$echo .= '<tr>';
			$echo .= '<th>' . $tr['fb_id'] . '</th>';
			$echo .= '<th>' . $tr['fb_time'] . '</th>';
			$echo .= '<th>' . $tr['fb_article'] . '</th>';
			$echo .= '<th>' . $tr['fb_text'] . '</th>';
			$echo .= '<th>' . $button[0] . $tr['fb_id'] . $button[1] . '</th>';
			$echo .= '</tr>';
			$row_num1--;
		}
	}

	echo $echo;
?>

		<div class="checked">
			 <table>
			 	<tr>
			    	<th>ID</th>
			    	<th>CHECKED_TIME</th>
			    	<th>ARTICLE</th>
			    	<th>TEXT</th>
			    	<th>DONE?</th>
			 	</tr>
				
<?php
	$button = ['
		<form action="dev-php/check-fb.php" method="post">
		   <input class="c_btn" type="submit" name="','" value="undo"/>
		</form>
	'];

	$echo = '';

	for ($i = 1; $i <= 20; $i++) {
		if ($row_num2 > 0){
			$tr = mysqli_fetch_assoc($checked);
			$echo .= '<tr>';
			$echo .= '<th>' . $tr['fb_id'] . '</th>';
			$echo .= '<th>' . $tr['fb_check_time'] . '</th>';
			$echo .= '<th>' . $tr['fb_article'] . '</th>';
			$echo .= '<th>' . $tr['fb_text'] . '</th>';
			$echo .= '<th>' . $button[0] . $tr['fb_id'] . $button[1] . '</th>';
			$echo .= '</tr>';
			$row_num2--;
		}
	}

	echo $echo;
?>

			</table> 
		</div>
	</div>

</body>
</html>