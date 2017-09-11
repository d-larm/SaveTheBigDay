<?php session_start(); ?>
<?php include "database.php" ?>
<?php include "securetext.php" ?>
<?php
	//all errors that occur and kept in the database
	$user = secure($_POST["id"]); //Selected category
	$database = new Database();
	$data = array();
	$query = $database->query("SELECT * FROM MESSAGES WHERE receiver='{$user}' ORDER BY Timestamp DESC");
	while(($messages = mysqli_fetch_assoc($query))){
		$senderId = $messages["Sender"];
		$nameQuery = $database->query("SELECT Name FROM USERS WHERE userID='{$senderId}'");
		$messages["Sender"]=$nameQuery;
		array_push($data,$messages); //Gets all page information in the array as response to ajax request
    }
    echo json_encode($data);

?>
