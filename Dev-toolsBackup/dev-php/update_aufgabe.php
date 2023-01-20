<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}

if(isset($_GET['updatestuff_submit']) && isset($_GET['updateaufgabe_text']) && isset($_GET['updatesol_text'])){
	echo "<div class='isupdated'> Content now live! </div>";

	$update_ex_query = "UPDATE `exercises` SET `ex_aufgabe` = '" . mysqli_real_escape_string ($conn, $_GET['updateaufgabe_text']) . "', `ex_sol` = '" . mysqli_real_escape_string ($conn, $_GET['updatesol_text']) . "' WHERE `exercises`.`ex_id` = '" . $_GET['update_ex_id'] . "'; ";
	mysqli_query($conn, $update_ex_query);
}

$mysql_query_ex = "SELECT ex_aufgabe, ex_sol FROM exercises WHERE ex_id = '" . $_GET['update_ex_id'] . "'";
$result = mysqli_query($conn, $mysql_query_ex);
$mysql_result_ex = mysqli_fetch_assoc($result);

$mysql_sol = $mysql_result_ex['ex_sol'];
$mysql_auf = $mysql_result_ex['ex_aufgabe'];

if(!isset($_GET['updatesol_text'])){
	$updatesol_text = $mysql_sol;
}	else {$updatesol_text = $_GET['updatesol_text'];}

if(!isset($_GET['updateaufgabe_text'])){
	$updateauf_text = $mysql_auf;
}	else {$updateauf_text = $_GET['updateaufgabe_text'];}

if($updateauf_text == ""){$updateauf_text = "Aufgabe NEW";}
if($updatesol_text == ""){$updatesol_text = "Lösung NEW";}

$latex_replaced1 = str_replace('$$', '[$[$]$]', $updateauf_text);
$latex_replaced1 = str_replace('\\(', '[$($[', $latex_replaced1);
$latex_replaced1 = str_replace('\\)', ']$)$]', $latex_replaced1);

$latex_replaced2 = str_replace('$$', '[$[$]$]', $updatesol_text);
$latex_replaced2 = str_replace('\\(', '[$($[', $latex_replaced2);
$latex_replaced2 = str_replace('\\)', ']$)$]', $latex_replaced2);

$code_aufg = str_replace('\\\\', '\\\\\\\\', $updateauf_text); 
$code_aufg = nl2br(str_replace("\begin", "\<s>.</s>begin", htmlspecialchars($code_aufg)));

$code_sol = str_replace('\\\\', '\\\\\\\\', $updatesol_text); 
$code_sol = nl2br(str_replace("\begin", "\<s>.</s>begin", htmlspecialchars($code_sol)));

?>
<style type="text/css">
	.form-box > span:nth-child(1){
		font-size: 25px;
		margin: 10px 0px 20px 0px;
		display: inline-block;
	}

	.form-box > span:nth-child(1) > span:nth-child(1){
		min-width: 400px;
		display: inline-block;
	}

	.form-box .code-ex{
		display: flex;
		flex-direction: row;
	}

	.form-box .prev-ex{
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

	.form-box div:nth-child(4){
		display: flex;
		flex-direction: row;
	}

	.form-box div:nth-child(4) form{
		width: 780px;
		display: flex;
		flex-direction: column;
		justify-content: flex-end;
	}

	.form-box div:nth-child(4) form textarea{
		margin-top: 40px;
		width: 780px;
		box-sizing: border-box;
		height: 300px;
	}

	.form-box div:nth-child(4) form input[type ="submit"]{
		width: 300px;
		margin: 20px 0px 0px 0px;
		font-size: 25px;
	}

	.form-box div:nth-child(4) form:nth-child(2) textarea{
		margin-left: 40px;
	}

	.form-box div:nth-child(4) form:nth-child(2) input[type ="submit"]{
		margin-left: 40px;
	}

	.form-end{
		display: flex;
		flex-direction: row;
		margin-top: 50px;
	}

	.form-end form:nth-child(2) input{
		margin-left: 520px;
	}

	.form-end form input{
		background: unset;
		border-radius: 30px;
		font-weight: inherit;
		font-size: 25px;
		font-family: inherit;
		padding: 5px 10px 5px 10px;
		min-width: 150px;
		border: 2px solid #4ecba5;
		color: #4ecba5;
		width: 300px;
	}

	.form-end form input:hover{
		background: #4ecba5;
		color: white !important;
		transition-duration: .3s;
	}

	.isupdated{
		color: #4ecba5;
		font-size: 35px;
		margin: 50px 0px 20px 0px;
	}

	<?php
		$get_sytle_Q = "SELECT übungen_style FROM articles WHERE article_name = '" . $_GET['article_name'] . "'";
		echo mysqli_fetch_assoc(mysqli_query($conn, $get_sytle_Q))['übungen_style'];
	?>
</style>

<div class="form-box"><span><span>Aufgabe <?php echo $_GET['update_ex_rf'] ?></span>| ID = <?php echo $_GET['update_ex_id'] ?></span>
	<div class="prev-ex">
		<div class="prev-aufg" contenteditable="true" spellcheck="true">
			<?php 
				echo $latex_replaced1;
			?>
		</div>
		<div class="prev-sol solution" contenteditable="true" spellcheck="true">
			<?php 
				echo $latex_replaced2;
			?>
		</div>
	</div>
	<div class="code-ex">
		<div class="code-aufg" contenteditable="true" spellcheck="true">
			<?php 
				echo $code_aufg;
			?>
		</div>
		<div class="code-sol" contenteditable="true" spellcheck="true">
			<?php 
				echo $code_sol;
			?>
		</div>
	</div>
	<div>
		<form class="ex_form"><input type="hidden" name="what" value="exercises"/>
		<input type="hidden" name="article_name" value= <?php echo "'" . $_GET['article_name'] . "'"?>/><input type="hidden" name="update_ex_rf" value=<?php echo "'" . $_GET['update_ex_rf'] . "'"?>/><input type="hidden" name="update_ex_id" value=<?php echo "'" . $_GET['update_ex_id'] . "'"?>/><input type="hidden" name="search" value="Search"/>
		<input type="hidden" name="updatesol_text" value=<?php echo "'" . $updatesol_text . "'";?>/>
		<textarea name="updateaufgabe_text"><?php echo $updateauf_text ;?></textarea>
		<input type="submit" name="update_aufgabe" value="Update Aufgabe"/>
		</form>

		<form class="ex_form"><input type="hidden" name="what" value="exercises"/>
		<input type="hidden" name="article_name" value= <?php echo "'" . $_GET['article_name'] . "'"?>/><input type="hidden" name="update_ex_rf" value=<?php echo "'" . $_GET['update_ex_rf'] . "'"?>/><input type="hidden" name="update_ex_id" value=<?php echo "'" . $_GET['update_ex_id'] . "'"?>/><input type="hidden" name="search" value="Search"/>
		<input type="hidden" name="updateaufgabe_text" value=<?php echo "'" . $updateauf_text . "'";?>/>
		<textarea name="updatesol_text"><?php echo $updatesol_text ;?></textarea>
		<input type="submit" name="update_aufgabe" value="Update Lösung"/>
		</form>
	</div>
</div>

<div class="form-end">
	<form>
		<input type="hidden" name="what" value="exercises">
		<input type="hidden" name="search" value="Search">
		<input type="hidden" name="article_name" value=<?php echo "'" . $_GET['article_name'] . "'";?>>
		<input type="submit" name="zurück" value="Zurück">
	</form>
	<form>
		<input type="hidden" name="what" value="exercises"/>
		<input type="hidden" name="article_name" value= <?php echo "'" . $_GET['article_name'] . "'"?>/><input type="hidden" name="update_ex_rf" value=<?php echo "'" . $_GET['update_ex_rf'] . "'"?>/><input type="hidden" name="update_ex_id" value=<?php echo "'" . $_GET['update_ex_id'] . "'"?>/><input type="hidden" name="search" value="Search"/>
		<input type="hidden" name="updateaufgabe_text" value=<?php echo "'" . $updateauf_text . "'";?>/>
		<input type="hidden" name="updatesol_text" value=<?php echo "'" . $updatesol_text . "'";?>/>
		<input type="hidden" name="updatestuff_submit" value="submit_übungen"/>
		<input type="submit" name="update_aufgabe" value="Submit"/>
	</form>
</div>