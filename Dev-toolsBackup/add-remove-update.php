<?php 
	//Nur ich kann zugreifen (meine IP)
	include_once '../Import/php/restrict-access.php';
	include_once '../Import/php/database.php';

	$themengebiete = QuerySQL("SELECT * FROM themengebiete");
	$row_num1 = mysqli_num_rows($themengebiete);
	$subg = QuerySQL("SELECT * FROM subgebiete");
	$row_num2 = mysqli_num_rows($subg);

	$echo_tg = '';
	while ($tr_tg = mysqli_fetch_assoc($themengebiete)) {
		$echo_tg .= '<tr>';
		$echo_tg .= '<th>'. htmlspecialchars($tr_tg['tg_id']) . '</th>';
		$echo_tg .= '<th>'. htmlspecialchars($tr_tg['tg_name']) . '</th>';
		$echo_tg .= '<th>'. htmlspecialchars($tr_tg['tg_introduction']) . '</th>';
		$echo_tg .= '<th>'. htmlspecialchars($tr_tg['link_blue']) . '</th>';
		$echo_tg .= '<th>'. htmlspecialchars($tr_tg['rechner']) . '</th>';
		$echo_tg .= '</tr>';
	}

	$echo_subg = '';
	while ($tr_subg = mysqli_fetch_assoc($subg)) {
		$echo_subg .= '<tr>';
		$echo_subg .= '<th>'. htmlspecialchars($tr_subg['sub_id']) . '</th>';
		$echo_subg .= '<th>'. htmlspecialchars($tr_subg['sub_name']) . '</th>';
		$echo_subg .= '<th>'. htmlspecialchars($tr_subg['tg_name']) . '</th>';
		$echo_subg .= '</tr>';
	}

	$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
	<title>ADD, REMOVE, UPDATE</title>
	<link href="https://fonts.googleapis.com/css2?family=MuseoModerno&display=swap" rel="stylesheet"> <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
<?php include_once "ScriptIncludeStuff.php" ?>
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

		.disnone{
			display: none;
		}

		.label{
			margin-top: 50px;
			font-size: 40px;
			display: flex;
			flex-direction: row;
			cursor: pointer;
		}

		.label .arrows{
			display: flex;
			flex-direction: row;
			margin-left: 10px;
			margin-top: 17px;
		}

		.label .arrows div{
			width: 25px;
			height: 25px;
			border-left: 4px white solid;
			border-top: 4px white solid;
			transform: rotate(135deg);
		}

		.label .arrows div:nth-child(2){
			margin-left: -15px;
		}

		.label:hover{
			color: rgb(200,200,200);
			transition-duration: .3s;
		}

		.label:hover .arrows div{
			color: rgb(200,200,200);
			transition-duration: .3s;
			border-color: rgb(200,200,200);
		}

		.labelwr{
			width: 600px;
			display: flex;
			flex-direction: row;
		}

		.active .arrows{
			transform: rotate(90deg);
			margin-top: -15px;
			margin-left: -10px;
		}

		.amount{
			color: #187bcd;
		}

		table{
			margin-top: 80px;
			text-align: left;
			font-family: 'Roboto', sans-serif;
		}

		.tg_table tr th:nth-child(1){
			width: 100px;
		}

		.tg_table tr th:nth-child(2){
			width: 150px;
		}

		.tg_table tr th:nth-child(3){
			width: 500px;
		}

		.tg_table tr th:nth-child(4){
			width: 400px;
		}

		.tg_table tr th:nth-child(5){
			width: 200px;
		}


		.sub_table tr th:nth-child(1){
			width: 100px;
		}

		.sub_table tr th:nth-child(2){
			width: 300px;
		}

		.sub_table tr th:nth-child(3){
			width: 300px;
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

		.add form, .update form{
			display: flex;
			flex-direction: row;
		}

		.show_tg .add form div:nth-child(1) textarea {width: 170px;}
		.show_tg .add form div:nth-child(2) textarea {width: 400px;}
		.show_tg .add form div:nth-child(3) textarea {width: 210px;}
		.show_tg .add form div:nth-child(4) textarea {width: 200px;}

		.show_tg .update form div:nth-child(1) textarea {width: 70px;}
		.show_tg .update form div:nth-child(2) textarea {width: 170px;}
		.show_tg .update form div:nth-child(3) textarea {width: 400px;}
		.show_tg .update form div:nth-child(4) textarea {width: 210px;}
		.show_tg .update form div:nth-child(5) textarea {width: 200px;}

		.add div , .update div{
			margin-right: 20px;
		}

		.submit_new{
			background: unset;
			border-radius: 30px;
			font-weight: inherit;
			font-size: inherit;
			font-family: inherit;
			padding: 5px 10px 5px 10px;
			min-width: 150px;
			margin-top: 35px;
		}

		.add .submit_new{
			margin-left: 95px;
			border-color: #187bcd;
			color: #187bcd;
		}

		.add_sub .submit_new{
			margin-left: 200px;
		}

		.tg_go{
			border: 2px solid #4ecba5;
			color: #4ecba5;
		}

		.tg_go:hover{
			background: #4ecba5;
			color: white !important;
			transition-duration: .3s;
		}

		.add .tg_go:hover{
			background: #187bcd;
		}

		.top_name{
			margin-top: 40px;
			font-family: 'MuseoModerno', cursive;
			font-size: 25px;
		}

		.editorlink{
			text-decoration-line: none;
			color: white;
		}

		.editorlink:hover{
			color: rgb(200,200,200);
			transition-duration: .3s;
		}
	</style>
	<script type="text/javascript" src="../Import/js/changeclass.js"></script>
</head>

<body>
	<div class="main">
		<a class ="zurück" href="../Dev-tools">Zurück</a>
		<span class="topbar"></span>
		<span class="top">Add, remove, update</span>
		<div class="line line1"></div>

		<div id="themengebiete" class="label active" onclick="
				toggleClass('#themengebiete', 'active');
				toggleClass('.show_tg ', 'disnone');";>
			<span class="labelwr">
				<span class="name">Themengebiete</span>
				<span class="arrows">
					<div></div>
					<div></div>
				</span>
			</span>
			<span class="amount">Amount: <?php echo $row_num1;?></span>
		</div>

		<div class="show_tg">
			<table class="tg_table">
				 	<tr>
				    	<th>ID</th>
				    	<th>NAME</th>
				    	<th>INTRODUCTION</th>
				    	<th>LINK_BLUE</th>
				    	<th>RECHNER</th>
				 	</tr>
					<?php echo $echo_tg ?>
			</table>
			<div class="add">
				<div class="top_name">ADD</div>
				<form action="dev-php/add-update.php">
					<div>
						<label for="tg_name">Themengebiet - Name:</label><br>
						<textarea name="tg_name" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<label for="tg_intro">Introduction:</label><br>
						<textarea name="tg_intro" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<label for="tg_lb">Link - Blue:</label><br>
						<textarea name="tg_lb" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<label for="tg_rechner">Rechner:</label><br>
						<textarea name="tg_rechner" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<input class="tg_go submit_new" type="submit" name="tg_go" value="Add"/>
					</div>
				</form> 
			</div>

			<div class="update">
				<div class="top_name">UPDATE</div>
				<form action="dev-php/add-update.php">
					<div>
						<label for="tg_name">TG - ID:</label><br>
						<textarea name="tg_id" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<label for="tg_name">Themengebiet - Name:</label><br>
						<textarea name="tg_name" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<label for="tg_intro">Introduction:</label><br>
						<textarea name="tg_intro" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<label for="tg_lb">Link - Blue:</label><br>
						<textarea name="tg_lb" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<label for="tg_rechner">Rechner:</label><br>
						<textarea name="tg_rechner" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<input class="tg_go submit_new" type="submit" name="tg_go" value="Update"/>
					</div>
				</form> 
			</div>

			<div class="remove">
				<div class="top_name">REMOVE</div>
				<span>DELETE FROM themengebiete WHERE tg_id = $themengebiet_id<pre style="display: inline;">    </pre>|<pre style="display: inline;">    </pre><a href="write_mySQL?query=DELETE FROM themengebiete WHERE tg_id = $themengebiet_id" class="editorlink">MySQL - Editor</a></span>
			</div>
		</div>

		<div id="subgebiete" class="label active" onclick="
				toggleClass('#subgebiete', 'active');
				toggleClass('.show_subg', 'disnone');";>
			<span class="labelwr">
				<span class="name">Subgebiete</span>
				<span class="arrows">
					<div></div>
					<div></div>
				</span>
			</span>
			<span class="amount">Amount: <?php echo $row_num2;?></span>
		</div>
		<div class="show_subg">
			<table class="sub_table">
				 	<tr>
				    	<th>ID</th>
				    	<th>NAME</th>
				    	<th>TEILGEBIET</th>
				 	</tr>
					<?php echo $echo_subg ?>
			</table>
			<div class="add add_sub">
				<div class="top_name">ADD</div>
				<form action="dev-php/add-update.php">
					<div>
						<label for="tg_name">Subgebiet - Name:</label><br>
						<textarea name="sub_name" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<label for="sub_tg">Teilgebiet:</label><br>
						<textarea name="sub_tg" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<input class="tg_go submit_new" type="submit" name="tg_go" value="Add_sub"/>
					</div>
				</form> 
			</div>

			<div class="update">
				<div class="top_name">UPDATE</div>
				<form action="dev-php/add-update.php">
					<div>
						<label for="sub_name">Sub - ID:</label><br>
						<textarea name="sub_id" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<label for="sub_name">Subgebiet - Name:</label><br>
						<textarea name="sub_name" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<label for="sub_tg">Teilgebiet:</label><br>
						<textarea name="sub_tg" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
					</div>
					<div>
						<input class="tg_go submit_new" type="submit" name="tg_go" value="Update_sub"/>
					</div>
				</form> 
			</div>

			<div class="remove">
				<div class="top_name">REMOVE</div>
				<span>DELETE FROM subgebiete WHERE sub_id = $sub_id<pre style="display: inline;">    </pre>|<pre style="display: inline;">    </pre><a href="write_mySQL?query=DELETE FROM subgebiete WHERE sub_id = $sub_id" class="editorlink">MySQL - Editor</a></span>
			</div>
		</div>
	</div>

</body>
</html>