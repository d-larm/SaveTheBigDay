<?php session_start(); ?>
<?php include "database.php" ?>
<?php include "securetext.php" ?>
<?php

	//all errors that occur and kept in the database
	$database = new Database();
	$id = $_SESSION['id'];



	$queryString = "INSERT INTO Messages VALUES ('','{$email}','{$password}','{$firstname}','{$lastname}','{$address1}','{$city}','{$country}','{$postcode}',{$telephone1},{$telephone2},{$salt})";
	
	if($database->query($queryString)){
		$success = true;
		$message = "Account created successfully";
	}else
		$message =  $database->fetchConnection()->error;

	$database = null;
	$data = array("success"=>$success,"message"=>$message);
	echo json_encode($data);
?>
