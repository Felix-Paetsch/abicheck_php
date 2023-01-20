<?php 
	//Nur ich kann zugreifen (meine IP)
	include_once '../Import/php/restrict-access.php';
	include_once '../Import/php/database.php';
	
	if (isset($_GET['what'])){
		if($_GET['what'] == "exercises" && isset($_GET['add_new_ex'])){
			include_once 'dev-php/add_new_ex.php';
		}
	}

//update article php
if(isset($_GET['update_submit'])){
	if(isset($_POST['new_article_name'])){
		$key = "article_name";
		$value = $_POST['new_article_name'];
	}
	if(isset($_POST['sub_name'])){
		$key = "sub_name";
		$value = $_POST['sub_name'];
	}
	if(isset($_POST['article_meta'])){
		$key = "article_meta";
		$value = $_POST['article_meta'];
	}
	if(isset($_POST['article_style'])){
		$key = "article_style";
		$value = $_POST['article_style'];
	}
	if(isset($_POST['übungen_style'])){
		$key = "übungen_style";
		$value = $_POST['übungen_style'];
	}
	$update_meta_query = "UPDATE `articles` SET " . $key . " = ? WHERE `articles`.`article_name` = ? ; ";
	SaveQuerySQL($update_meta_query, [str_replace(["\n", "\r"], ["", ""], $value), $_GET['article_name']], "ss");
}

if (isset($_POST["add_new_article"]) && $_POST["article_name"] != ""){
	$exist_result_for_new_article = QuerySQL('SELECT article_id FROM articles WHERE article_name = ?', [$_POST['article_name']], "s");
	if (mysqli_num_rows($exist_result_for_new_article) == 0){
		$max_q_result = QuerySQL($max_rhf_q = 'SELECT MAX( reihenfolge ) as reihenfolge FROM articles WHERE sub_name = ?', [$_POST['sub_name']], "s");
		$max_rhf =  mysqli_fetch_assoc($max_q_result)['reihenfolge'] + 1;

		$mysqli_insert__query = "INSERT INTO `articles` (`article_id`, `article_name`, `sub_name`, `article_style`, `übungen_style`, `reihenfolge`, `article_meta`) VALUES 
							(NULL, ?, ?, ?, ?, ?, ?); ";
		$params = [
			$_POST["article_name"],
			$_POST['sub_name'],
			$_POST['article_style'],
			$_POST['übungen_style'],
			$max_rhf,
			$_POST['article_meta']
		];
		SaveQuerySQL($mysqli_insert__query, $params, "ssssis");
	} else {$ArticleAlreadyExists = TRUE;}
}
?>


<!DOCTYPE html>
<html>
<head>

	<title>Articles</title>

	<?php include_once "ScriptIncludeStuff.php" ?>
	<link rel="stylesheet" type="text/css" href="../Import/css/tools.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/übungen.css">


	<link rel="stylesheet" type="text/css" href="../Import/css/allgemeinformat.css">
	<link rel="stylesheet" type="text/css" href="../Import/css/header.css">


	<link rel="stylesheet" type="text/css" href="articles.css">
</head>
<body>
	<div class="main">
		<a class ="zurück" href="index.php">Zurück</a>
		<span class="topbar"></span>
		<span class="top">Articles</span>
		<span class="topbar"></span>
		<span class="top" style="color: #187bcd;"><?php 
			echo (isset($_GET['article_name']) && $_GET['article_name'] != "") ? $_GET['article_name'] : 'Foli';
		?></span>
		<div class="line line1"></div>

		<form class="top_select" action="articles.php">
			<div>
				<label for="where">Bearbeiten:</label><br>
				<select name="what" class="classic">
					<option value="meta">Article - META</option>
					<option value="content">Article - CONTENT</option>
					<option value="exercises">Article - EXERCISES</option>
				</select> 
			</div>
			<div class="name">
				<label for="article_name">Name:</label><br>
				<input type="text" name="article_name">
			</div>
			<div>
				<input class="submit_new" type="submit" name="search" value="Search"/>
			</div>
			<div>
				<input class="submit_new new_article" type="submit" name="new_article" value="Neuer Artikel"/>
			</div>
		</form>


<?php 
	echo isset($ArticleAlreadyExists) ? '<br> Artikel existierte schon' : "";

	if (!isset($_GET["new_article"]) && (isset($_POST['article_name']) || isset($_GET['article_name']))&& $_GET['what'] == 'meta') include_once "dev-php/article_meta.php"; 
	if (isset($_GET['new_article'])){
		include_once 'dev-php/new_article_wrapper.php';
	}
	if (isset($_GET["what"])) if ($_GET["what"] == "content" && !isset($_POST['update_content'])) include_once 'dev-php/article_content.php'?>

<?php 
if(isset($_POST['update_content'])){
	if(isset($_GET['update_content_rf'])){
		include_once 'dev-php/update_content.php';
	}

	if($_GET['what'] == "exercises"){
		include_once 'dev-php/manipulate-article-exercises.php';
	}
}?>

<?php if(isset($_GET['what'])){
	if($_GET['what'] == "exercises" && !isset($_GET['update_aufgabe'])){
		include_once 'dev-php/manipulate-article-exercises.php';
	} elseif($_GET['what'] == "exercises" && isset($_GET['update_aufgabe'])){
		include_once 'dev-php/update_aufgabe.php';
	}
}?>


</div>


</body>
</html>