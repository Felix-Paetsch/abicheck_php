<div class="main-order">

<?php
if($_GET['where'] == 'articles'){
	$where = 'articles';
	$rhf = 'reihenfolge';
	$id_type = 'article_id';

	$gettable_query = "SELECT article_id, article_name, reihenfolge FROM " . $where . " WHERE sub_name = '" . $_GET['order_name'] . "' ORDER BY " . $rhf . " ASC;";
	$querytype = "A";
} elseif($_GET['where'] == 'content'){
	$where = 'contents';
	$rhf = 'reihenfolge';
	$id_type = 'content_id';

	$gettable_query = "SELECT content_id, content_name, sub_name, reihenfolge FROM " . $where . " WHERE article_name = '" . $_GET['order_name'] . "' ORDER BY " . $rhf . " ASC;";
	$querytype = "B";
} elseif($_GET['where'] == 'ex'){
	$where = 'exercises';
	$rhf = 'ex_reihenfolge';
	$id_type = 'ex_id';

	$gettable_query = "SELECT ex_id, ex_aufgabe, ex_reihenfolge FROM " . $where . " WHERE article_name = '" . $_GET['order_name'] . "' ORDER BY " . $rhf . " ASC;";
	$querytype = "C";
} else{ echo 'no query selected ERROR';};

$result = mysqli_query($conn, $gettable_query);

//update id
$elements_num = mysqli_num_rows($result);

	if(isset($_GET['update_go'])){
		for($i = 1; $i <= $elements_num; $i++){
			$update_query = "UPDATE " . $where . " SET " . $rhf . " = " . $i . " WHERE " . $id_type . " = '" . $_GET['rhf' . $i] . "';";
			$return = SaveQuerySQL($update_query);
		}
	}

$result = mysqli_query($conn, $gettable_query);

if (mysqli_num_rows($result) == 0){
	echo "Keine Ergebnisse ...";
} else {
	include_once "order-stuff-result.php";
}

?>

</div>


	</div>

	<div class="float">

	<table>
	 	<tr>
	 		<th>ID</th>
	    	<th>NAME / CONTENT</th>
	    	<th>ORDER</th>
	 	</tr>

<?php 
	$echorow = "";

	while ($row = mysqli_fetch_assoc($result)) {
		if ($querytype == "A"){
			$echoid = $row['article_id'];
			$echoname = $row['article_name'];
			$echo_rhf = $row['reihenfolge'];
		} elseif ($querytype == "B"){
			$echoid = $row['content_id'];
			$echoname = $row['content_name'];
			$echo_rhf = $row['reihenfolge'];
		} else {
			$echoid = $row['ex_id'];
			$echoname = $row['ex_aufgabe'];
			$echo_rhf = $row['ex_reihenfolge'];
		}
			$echorow .= '<tr><th>' . $echoid. "</th>";
			$echorow .= '<th>' . $echoname . "</th>";
			$echorow .= '<th>' . $echo_rhf . "</th></tr>";
	}
	echo $echorow;
?>
	</table>

	<form class="set_order" action="order-stuff.php">

<?php
	for($i = 1; $i <= $elements_num; $i++){
		echo '
			<div><label for="rhf' . $i . '">' . $i . '. Element (Id):</label><br>
			<input type="number" name="rhf' . $i . '"></div>';
	}
?>
		<input class="submit_rhf submit_new" type="submit" name="update_go" value="submit"/>
		<input type="hidden" name="where" value=<?php  echo '"' . $_GET['where'] . '"'?>>
		<input type="hidden" name="order_name" value=<?php  echo '"' . $_GET['order_name'] . '"'?>>
		<input type="hidden" name="submit" value ="Search" value=<?php  echo '"' . $_GET['submit'] . '"'?>>
	</form>
	</div>

	<div class="remove">
		<div class="top_name">REMOVE</div>
		<span>DELETE FROM <?php echo $where ?> WHERE <?php echo $id_type ?> = $id<pre style="display: inline;">    </pre>|<pre style="display: inline;">    </pre>
			<a <?php echo 'href="write_mySQL?query=' . 'DELETE FROM ' . $where . ' WHERE ' . $id_type . ' = $id "' ;?>class="editorlink">MySQL - Editor</a></span>
	</div>

	</div>
	</div>
	</div>