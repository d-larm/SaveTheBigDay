<?php session_start(); ?>
<?php include "database.php" ?>
<?php include "securetext.php" ?>
<?php
	//all errors that occur and kept in the database
	$category = secure($_POST["category"]); //Selected category
	$filter1 = secure($_POST["filter1"]); //Filter for price, ratings, distance etc.
	$order = secure($_POST["orders"]); //Order ascending or descending
	$database = new Database();
	$data = array();
	$query = $database->query("SELECT * FROM VENDORPAGES WHERE cateogry='{$category}' ORDER BY {$filter1} {$order}");
	while(($pages = mysqli_fetch_assoc($query))){
		array_push($data,$pages); //Gets all page information in the array as response to ajax request
    }
    echo json_encode($data);

?>
