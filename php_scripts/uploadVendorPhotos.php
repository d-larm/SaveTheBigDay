<?php session_start(); ?>
<?php include "database.php" ?>
<?php include "securetext.php" ?>
<?php
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.


//all errors that occur and kept in the database
$database = new Database();
$accepted = false;
$salt = rand(1, 10000);
$success = false;

$email = secure($_POST["email"]);
// $password = sha1(secure($_POST["password"]).$salt);
$name = secure($_POST["name"]);
$category = secure($_POST["category"]);
$tags = secure($_POST["tags"]);
$address1 = secure($_POST["address1"]);
$address2 = secure($_POST["address2"]);
$city = secure($_POST["city"]);
$postcode = secure($_POST["postcode"]);
$telephone1 = secure($_POST["telephone1"]);
$telephone2 = secure($_POST["telephone2"]);
$website = secure($_POST["website"]);
$facebook = secure($_POST["facebook"]);
$instagram = secure($_POST["instagram"]);
$twitter = secure($_POST["twitter"]);
$isOwner = secure($_POST["isOwner"]);




$queryString = "INSERT INTO VendorUser VALUES ('','{$name}','{$category}','{$tags}','{$address1}','{$address2}','{$city}','{$postcode}','{$website}','{$email}','{$telephone1}','{$telephone2}','{$facebook}','{$instagram}','{$twitter}',false)";

if($database->query($queryString)){
	$success = true;
	$message = "Vendor page created successfully";
}else
	$message =  $database->fetchConnection()->error;

$data = array("success"=>$success,"message"=>$message);

if($data["success"]){
	$vendorId = $database->fetchConnection()->insert_id;
	//Upload files to the vendor's directory
	$uploaddir = '../img/vendors/'.$vendorId.'/v/';

	if(!file_exists($uploaddir)){
	    mkdir($uploaddir, 0777, true);
	}

	$fi = new FilesystemIterator($uploaddir, FilesystemIterator::SKIP_DOTS); //Gets the number of photos in the directory
	$fileCount = iterator_count($fi);


	if(!empty($_FILES)){
		for($i=0;$i<count($_FILES['vendorfiles']['name']);$i++){
			if($_FILES['vendorfiles']['type'][$i] == "image/jpeg")
				$uploadfile = $uploaddir . basename("v({$fileCount}).jpg"); //Name if file is jpeg
			else if($_FILES['vendorfiles']['type'][$i] == "image/png")
				$uploadfile = $uploaddir . basename("v({$fileCount}).png"); //Name if file is png

			if (move_uploaded_file($_FILES['vendorfiles']['tmp_name'][$i], $uploadfile)) { //Uploads file
			    echo "File is valid, and was successfully uploaded.\n";
			} else {
			    echo "Possible file upload attack!\n";
			}
			$fileCount++;
		}
		// $uploadfile = $uploaddir . basename($_FILES['vendorfiles']['name'][0]);

		// 	if (move_uploaded_file($_FILES['vendorfiles']['tmp_name'][0], $uploadfile)) {
		// 	    echo "File is valid, and was successfully uploaded.\n";
		// 	} else {
		// 	    echo "Possible file upload attack!\n";
		// 	}
		echo 'Here is some more debugging info:';
		print_r($_FILES);
		print_r($_POST);

		print "</pre>";
	}else
		echo "No files";

}else{
	echo json_encode($data);
}




?>