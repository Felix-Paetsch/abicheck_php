<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "abicheck";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

function QuerySQL($sql, $params = [], $parameterTypes = ""){
	global $conn;

	$stmt = $conn->prepare($sql);
	if(!empty($params)) $stmt->bind_param($parameterTypes, ...$params);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	return $result;
}

function SaveQuerySQL($sql, $params = [], $parameterTypes = ""){
	global $conn;

	$stmt = $conn->prepare($sql);
	if(!empty($params)) $stmt->bind_param($parameterTypes, ...$params);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();
	insertQuery(QueryString($sql,$params));
	return $result;
}

function insertQuery($newQuery){
	$backupfile = file_exists('../Data/backup.txt') ? '../Data/backup.txt' : (file_exists('Data/backup.txt') ? 'Data/backup.txt' : '../../Data/backup.txt');
	$fp = fopen($backupfile, 'a');
	fwrite($fp, $newQuery);
	fclose($fp);
}

function QueryString($sql,$params) {
  global $conn;
	foreach ($params as $value) {
		$escapedParams[] = mysqli_real_escape_string($conn, $value);
	}
  $splitatquestionmark = explode("?", $sql . " ");
  $sql = $splitatquestionmark[0];
  for ($i = 0; $i<count($splitatquestionmark) - 1; $i++) {
    $sql .= "'" . $escapedParams[$i] . "'" . $splitatquestionmark[$i+1];
  }
  return "\n" . getdatetime() . "\n" . semicolonAtEnd($sql);
}

function getdatetime(){
  $date = new DateTime();
  $timestamp=$date->format("U")+(60*60*2);
  return "#" . $timestamp . "     " . gmdate("d/m/Y  H:i:s", $timestamp);
}

function semicolonAtEnd($newQuery){
	$newQuery = rtrim($newQuery);
	return substr($newQuery, -1) === ";" ? $newQuery : $newQuery . ";" ;
}
 /* $params => parameter, welche die "?" erstetzen in der Query. QuerySQL result ist desselbe, wie normal
 	$conn->close() rufen, before etwas html geladen ist!!!


$params = [
		"",
		'',
	];

$sql = "INSERT INTO `backup` (`id`, `name`, `stuff`, `timestamp`) VALUES (NULL, ?, ?, current_timestamp());";
$paramsTypes = "ss";

QuerySQL($sql, $params, $paramsTypes);


$conn->close();

*/

?>