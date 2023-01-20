<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}

$exist_result = QuerySQL('SELECT sub_name FROM articles WHERE article_name = ?', [$_GET['article_name']], "s");
if (mysqli_num_rows($exist_result) == 0){
	echo "Artikel existiert nicht.";
	die();
}

$sub_name = mysqli_fetch_assoc($exist_result)['sub_name'];
$tg_result = QuerySQL('SELECT tg_name FROM subgebiete WHERE sub_name = ?', [$sub_name], "s");
$tg_name = mysqli_fetch_assoc($tg_result)['tg_name'];

$article_link = '<a href=../' . $tg_name . '/?' . urlencode($sub_name) . '/' . urlencode($_GET['article_name']) . '>' . $_GET['article_name'] . "</a>";
$übungen_style = QuerySQL("SELECT übungen_style FROM articles WHERE article_name = ?;", [$_GET['article_name']], "s");

$ex_ex = QuerySQL('SELECT ex_aufgabe, ex_sol, ex_id FROM exercises WHERE article_name = ?', [$_GET['article_name']], "s");
$i = 0;

$html_array = ['<div class="form-box"><span><span>Aufgabe ',
	'</span></span><div class="prev-ex"> <div class="prev-aufg">','</div><div class="prev-sol solution">','</div></div>
	<div class="code-ex"> <div class="code-aufg">','</div><div class="code-sol">','</div></div>
	<div><form class="ex_form"><input type="submit" name="update_aufgabe" value="Update Aufgabe"/><input type="hidden" name="what" value="exercises"/>
		<input type="hidden" name="article_name" value="' . $_GET['article_name'] . '"/><input type="hidden" name="update_ex_rf" value="', '"/><input type="hidden" name="update_ex_id" value="' , '"/><input type="hidden" name="search" value="Search"/></form>
	</div></div>'
];

$paste_html = "";

while ($ex = mysqli_fetch_assoc($ex_ex)){
	$latex_replaced1 = str_replace('$$', '[$[$]$]', $ex['ex_aufgabe']);
	$latex_replaced1 = str_replace('\\(', '[$($[', $latex_replaced1);
	$latex_replaced1 = str_replace('\\)', ']$)$]', $latex_replaced1);

	$latex_replaced2 = str_replace('$$', '[$[$]$]', $ex['ex_sol']);
	$latex_replaced2 = str_replace('\\(', '[$($[', $latex_replaced2);
	$latex_replaced2 = str_replace('\\)', ']$)$]', $latex_replaced2);

	$code_aufg = str_replace('\\\\', '\\\\\\\\', $ex['ex_aufgabe']); 
	$code_aufg = nl2br(str_replace("\begin", "\<s>.</s>begin", htmlspecialchars($code_aufg)));

	$code_sol = str_replace('\\\\', '\\\\\\\\', $ex['ex_sol']); 
	$code_sol = nl2br(str_replace("\begin", "\<s>.</s>begin", htmlspecialchars($code_sol)));

	$i++;
	$paste_html .= $html_array[0] . $i . "</span>| ID = " . $ex['ex_id'] . $html_array[1] . $latex_replaced1 . $html_array[2] . $latex_replaced2
		 . $html_array[3]  . $code_aufg . $html_array[4] . $code_sol . $html_array[5] . $i . $html_array[6] . $ex['ex_id'] . $html_array[7];
}
?>

<style type="text/css">
	.ex-top-row{
		display: flex;
		flex-direction: row;
		margin-top: 40px;
	}

	.ex-top-row div:nth-child(1){
		font-size: 30px;

		margin-top: 100px;
	}

	.ex-top-row div:nth-child(1):hover{
		color: rgb(200,200,200);
		transition-duration: .3s;
	}

	.ex-top-row div:nth-child(2){
		margin-left: 50px;
		margin-right: 50px;
		font-size: 30px;
		margin-top: 100px;
	}

	.ex-top-row div:nth-child(3){
		color: #187bcd;
		font-size: 30px;
		margin-top: 100px;
	}

	.ex-top-row form:nth-child(4){
		color: #187bcd;
		margin: 0px 0px 0px 50px;
		margin-top: 100px;
	}

	.ex-top-row form:nth-child(4) input{
		margin-top: 0px;
		height: 50px;
		font-size: 20px;
		width: 300px;
		color: #4ecba5;
		border-color: #4ecba5;
	}

	.ex-top-row form:nth-child(4) input:hover{
		background: #4ecba5;
	}

	.form-box .code-prev{
		display: flex;
		flex-direction: row;
		margin-top: 30px;
	}

	.prev-ex{
		display: flex;
		flex-direction: row;
	}

	.code-ex{
		display: flex;
		flex-direction: row;
	}

	.form-box .code-aufg, .form-box .code-sol{
		width: 500px;
		padding: 40px;
		background-color: rgb(90,90,90);
		margin-left: 40px;
		margin-top: 40px;
	}

	
	.form-box .prev-aufg, .form-box .prev-sol{
		background-color: rgb(200,200,200);
		width: 700px;
		padding: 40px;
		padding-left: 40px;
		margin-left: 40px;
		color: black;
	}

	.form-box .code-aufg, .form-box .prev-aufg{
		width: 700px;
		margin-left: 0px;
	}

	.form-box .code-sol{
		width: 700px;
	}

	.form-box .ex_form input[type="submit"]{
		margin: 20px 0px 0px 0px;
		width: 300px;
		font-size: 25px;
	}

	.form-box > span:nth-child(1){
		font-size: 25px;
		margin: 10px 0px 20px 0px;
		display: inline-block;
	}

	.form-box > span:nth-child(1) > span:nth-child(1){
		min-width: 400px;
		display: inline-block;
	}

	.top_wrapper_trenn{
			height: 250px;
			width: 3px;
			margin: 5px 90px 30px 130px;
			border-radius: 3px;
			background-color: white;
		}

	.top_wrapper_right{
		margin-top: -55px !important;
	}

	<?php
		echo mysqli_fetch_assoc($übungen_style)['article_style'];
	?>

</style>

<div class="ex-top-row">
	<div><?php echo $article_link;?></div>
	<div class="ex-trenn">|</div>
	<div>Aufgaben: <span><?php echo $i;?></span></div>
	<form class="form-box">
		<input type="submit" name="add_new_ex" value="Aufgabe hinzufügen">
		<input type="hidden" name="what" value="exercises">
		<input type="hidden" name="search" value="Search">
		<input type="hidden" name="article_name" value=<?php echo '"' . $_GET['article_name'] . '"' ?>>
	</form>
	<div class="top_wrapper_trenn"></div>
	<div class="top_wrapper_right">
		<a href=<?php echo "order-stuff.php?where=ex&order_name=" . $_GET['article_name'] . "&submit=Search"?>>Order</a>
		<a href="#">Overview</a>
		<a href="write_mySQL?query=DELETE FROM exercises WHERE ex_id = $id">Remove</a>
	</div>
</div>

<?php echo $paste_html; ?>

