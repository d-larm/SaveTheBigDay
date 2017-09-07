<?php session_start(); ?>
<?php include "database.php" ?>
<?php include "securetext.php" ?>
<?php
	//all errors that occur and kept in the database
	$email = secure($_POST["email"]);
	$password = secure($_POST["password"]);
	$database = new Database();
	$accepted = false;
	$query = $database->query("SELECT * FROM USERS WHERE email='{$email}'");
	while(($users = mysqli_fetch_assoc($query))){
        if($users["Password"] == sha1($password.$users["Salt"])){
            $_SESSION["id"]=$users["UserID"];
            $_SESSION["name"]=$users["FirstName"];
            $_SESSION["logged"]=1;
            $accepted = true;
        }
    }

    $data = array("success"=>$accepted,"name"=>$_SESSION["name"],"id"=>$_SESSION["id"]);
    echo json_encode($data);
    //echo json_encode($accepted);

?>
