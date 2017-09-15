<?php session_start(); ?>
<?php include "database.php" ?>
<?php include "securetext.php" ?>
<?php
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.

//all errors that occur and kept in the database

$vendorId = secure($_POST["id"]);
//Upload files to the vendor's directory
$uploaddir = '../img/vendors/'.$vendorId.'/v/';

if(!file_exists($uploaddir)){
    mkdir($uploaddir, 0777, true);
}

if(!empty($_FILES)){
		$uploadfile = $uploaddir . basename("profile.jpg"); //Name if file is jpeg
		move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile); //Uploads file
}else
	echo "No files";





?>