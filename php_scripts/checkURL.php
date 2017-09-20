<?php session_start(); ?>
<?php include "securetext.php" ?>
<?php
	$exists = false;
	$url = secure($_POST["url"]);

	if (@file_get_contents($url))
	$exists = true;

	echo json_encode($exists);

?>
<?php


?>