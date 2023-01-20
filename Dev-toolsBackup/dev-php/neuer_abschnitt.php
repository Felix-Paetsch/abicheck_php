<?php 
if(file_exists('../../Import/php/restrict-access.php')) {
    include_once '../../Import/php/restrict-access.php';
}

?><style type="text/css">
	.article-name{
		font-size: 28px;
		margin-top: 50px;
	}

	.fomfomfom{
		margin-top: 20px;
	}

	.fomfomfom label{
		font-size: 20px;
	}

	.fomfomfom input[name=submit]{
		margin-left: 30px !important;
		margin-top: 0px !important;
		width: 300px !important;
		color: #4ecba5 !important;
		border-color: #4ecba5 !important;
	}

	.fomfomfom input[name=submit]:hover{
		background: #4ecba5 !important;
	}
</style>

<div class="article-name top-name-link"><?php echo $content_link_array[0]?></div>

<form class="form-box fomfomfom">
	<label for="content_name">Abschnitt hinzufügen:</label>
	<input type="text" name="content_name" value="">

	<input type="submit" name="add_new_content" value="ADD">

	<input type="hidden" name="what" value="content">
	<input type="hidden" name="article_name" value=<?php echo '"' . $_GET['article_name'] . '"' ?>>
</form>