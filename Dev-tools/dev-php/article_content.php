<div class="main-order">
<div class = "content_wrapper">

<?php
$exist_result = QuerySQL('SELECT sub_name FROM articles WHERE article_name = ?', [$_GET['article_name']], "s");
if (mysqli_num_rows($exist_result) == 0){
	echo "Artikel existiert nicht.";
	die();
}

$sub_name = mysqli_fetch_assoc($exist_result)['sub_name'];
if(isset($_GET['add_new_content'])){
	$sql = "INSERT INTO `contents` (`content_id`, `article_name`, `sub_name`, `content_name`, `content_text`, `reihenfolge`) VALUES (NULL, ?, ?, 'Neuer Abschnitt', '', '');";
	SaveQuerySQL($sql, [$_GET['article_name'], $sub_name], "ss");
}
$contentmainsql = QuerySQL("SELECT * FROM contents WHERE article_name = ? ORDER BY `reihenfolge` ASC", [$_GET['article_name']], "s");
$tg_result = QuerySQL('SELECT tg_name FROM subgebiete WHERE sub_name = ?', [$sub_name], "s");
$tg_name = mysqli_fetch_assoc($tg_result)['tg_name'];

$contenturl = '<a href=../' . $tg_name . '/?' . urlencode($sub_name) . '/' . urlencode($_GET['article_name']) . '#';
$content_top_table_rows = '';
$content_link_array = [$contenturl . ">" . $_GET['article_name'] . "</a>"];
$content_big_form = '';

$contentFhtml = ['<div class="form-box">',
	'<div class="code-prev"><div class="codebox" contenteditable="true" spellcheck="true" lang="de">','</div><div class="prevbox content-box" contenteditable="true" spellcheck="true">','</div></div>

	<form class="content_form" action="articles.php?what=content&update_content=update&article_name=' . urlencode($_GET['article_name']) . "&update_content_rf=" , "&update_content_id=" ,
			 '&update_content_name=' , '" method="post">

	<div class="flex-top"><div class="flex-top-title">Update content</div>
		<input type="submit" name="update_content" value="Update content"/>
		</div>
		<textarea name="updatecontent_value" oninput=\'this.style.height = "";this.style.height = this.scrollHeight + "px"\'></textarea>
	</form></div>'
];

$i = 1;
while ($content = mysqli_fetch_assoc($contentmainsql)){
	$content_link_array[] = $contenturl . str_replace(" ","-", $content['content_name']) . "><span>" . $i . ". " . $content['content_name'] . "</span>| content_id = " . $content['content_id'] . " </a>";
	$content_top_table_rows .= '<tr><th>' . $content_link_array[$i] . "</th><th>" . $content['content_id'] . "</th></tr>";

	$latex_replaced = str_replace('$$', '[$[$]$]', $content['content_text']);
	$latex_replaced = str_replace('\\(', '[$($[', $latex_replaced);
	$latex_replaced = str_replace('\\)', ']$)$]', $latex_replaced);

	$replace_backslash = str_replace('\\\\', '\\\\\\\\', $content['content_text']);

	$content_big_form .= $contentFhtml[0] . $content_link_array[$i] . $contentFhtml[1] . nl2br(str_replace("\begin", "\<s>.</s>begin", htmlspecialchars($replace_backslash))) 
		. $contentFhtml[2] . $latex_replaced . $contentFhtml[3] . $i . $contentFhtml[4] . $content['content_id'] . $contentFhtml[5] . $content['content_name'] . $contentFhtml[6];
	$i++;
}

$style = QuerySQL("SELECT article_style FROM articles WHERE article_name = ?;", [$_GET['article_name']], "s");
?>

<style type="text/css">
	<?php
		echo mysqli_fetch_assoc($style)['article_style'];
	?>
</style>
	
<div class="content_top_wrapper">
	<div class="inhalt_links">
		<?php
			foreach ($content_link_array as $link){echo $link;}
		?>
		<form class="form-box">
			<input type="submit" name="add_new_content" value="Abschnitt hinzufügen">
			<input type="hidden" name="what" value="content">
			<input type="hidden" name="update_content" value="content">
			<input type="hidden" name="article_name" value=<?php echo '"' . $_GET['article_name'] . '"' ?>>
		</form>
	</div>
	<div class="top_wrapper_trenn"></div>
	<div class="top_wrapper_right">
		<a href=<?php echo "order-stuff.php?where=content&order_name=" . urlencode($_GET['article_name']) . "&submit=Search"?>>Order</a>
		<a href="overview.php">Overview</a>
		<a href="write_mySQL?query=DELETE FROM contents WHERE content_id = $id">Remove</a>
	</div>
</div>

<?php echo $content_big_form?>


</div> 

</div>