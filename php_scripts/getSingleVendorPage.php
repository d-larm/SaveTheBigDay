<?php include "database.php" ?>
<?php include "securetext.php" ?>
<?php
	//all errors that occur and kept in the database
	$pageID = secure($_POST["category"]); //Selected category
	$database = new Database();
	$query = $database->query("SELECT * FROM VENDORPAGES WHERE PageID='{$pageID}'");
	$data = mysqli_fetch_assoc($query);

?>
