<?php 
	if (isset($_GET['article_name']) && !isset($_POST['article_name'])) $_POST['article_name'] = $_GET['article_name'];
	$meta_query = "SELECT * FROM articles WHERE article_name = '" . $_POST['article_name'] . "';";
	$meta_run = mysqli_query($conn, $meta_query);

	function create_meta_form(){
		global $meta_run;
		$echo_meta = '';
		while ($meta_th = mysqli_fetch_assoc($meta_run)) {
			$echo_meta .= '<tr>';
			$echo_meta .= '<th>'. htmlspecialchars($meta_th['article_id']) . '</th>';
			$echo_meta .= '<th>'. htmlspecialchars($meta_th['article_name']) . '</th>';
			$echo_meta .= '<th>'. htmlspecialchars($meta_th['sub_name']) . '</th>';
			$echo_meta .= '<th>'. htmlspecialchars($meta_th['article_meta']) . '</th>';
			$echo_meta .= '<th>'. htmlspecialchars($meta_th['article_style']) . '</th>';
			$echo_meta .= '<th>'. htmlspecialchars($meta_th['übungen_style']) . '</th>';
			$echo_meta .= '</tr>';
			$echo_meta .= '<tr>';
			$echo_meta .= '<th></th>' . returnMetaFormHtmlSnippet('new_article_name');
			$echo_meta .= returnMetaFormHtmlSnippet('sub_name');
			$echo_meta .= returnMetaFormHtmlSnippet('article_meta');
			$echo_meta .= returnMetaFormHtmlSnippet('article_style');
			$echo_meta .= returnMetaFormHtmlSnippet('übungen_style') . "</tr>";
		}
		return $echo_meta;
	}

	function returnMetaFormHtmlSnippet($var){
		return '<th><form action="articles.php?update_submit=Update&what=meta&article_name=' . $_POST['article_name'] . '" method="POST"><div>
			<textarea name="' . $var . '" oninput=\'this.style.height = "";this.style.height = this.scrollHeight + "px"\'></textarea>
			<input type="submit" name="update_submit" value="Update">
					</div></form></th>';
	}
?>

<div class='div-meta'>
	<table class="meta-table">
		<tr>
			<th>ID</th>
			<th>ARTICLE_NAME</th>
			<th>SUB_NAME
			<th>META</th>
			<th>ARTICLE_STYLE</th>
			<th>ÜBUNGEN_STYLE</th>
		</tr>
	<?php	
		echo mysqli_num_rows($meta_run) == 0 ? "kein Artikel gefunden" : create_meta_form();
	?>

	</table>
		<div class="top_name">REMOVE</div>
		<span>DELETE FROM articles WHERE articles.article_id = $id"?<pre style="display: inline;">    </pre>|<pre style="display: inline;">    </pre><a href="write_mySQL?query=DELETE FROM articles WHERE article_id = $id" class="editorlink">MySQL - Editor</a></span>
</div>