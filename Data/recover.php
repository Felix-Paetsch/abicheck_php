<!DOCTYPE html>
<html>
<head>
	<title>RECOVER</title>
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
<?php
include_once "../Import/php/database.php";
include_once '../Import/php/restrict-access.php';
//REDO ALL STUFF AGAIN
//SET $RECOVER = TRUE

$RECOVER = TRUE;

if ($RECOVER === TRUE){
	recover();
	echo "<br>[1] heißt Query erfolgreich, [0] heißt Query nicht erfolgreich.";
	echo "<script type=\"text/javascript\">
			Swal.fire(
			  'Good job!',
			  'Alles ist wieder gut!',
			  'success'
			)
		</script>";
} else {
	echo "<script type=\"text/javascript\">
			Swal.fire({
			  icon: 'error',
			  title: 'Fehler!',
			  text: 'Recover disabled!',
			})
		</script>";
}

function recover(){
	global $conn;

	$success = [];
	$querySelection = file_get_contents('backup.txt');
	$splittedArray = preg_split('/\n#[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][ \t]+[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9][0-9][0-9][ \t]+[0-9][0-9]:[0-9][0-9]:[0-9][0-9]\n/', $querySelection);
	if(strlen($splittedArray[0]) < 10){array_shift($splittedArray);}
	foreach ($splittedArray as $value){
		$success[] = +mysqli_query($conn, $value);
	}
	print_r(array_count_values($success));
}

?>
</body>
</html>