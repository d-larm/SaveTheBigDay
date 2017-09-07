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


    //all errors that occur and kept in the database
    $database = new Database();
    $accepted = false;
    $salt = rand(1, 10000);
    $success = false;

    $email = secure($_POST["email"]);
    $password = sha1(secure($_POST["password"]).$salt);
    $firstname = secure($_POST["firstname"]);
    $lastname = secure($_POST["lastname"]);
    $address1 = secure($_POST["address1"]);
    $city = secure($_POST["city"]);
    $country = secure($_POST["country"]);
    $postcode = secure($_POST["postcode"]);
    $telephone1 = secure($_POST["telephone1"]);
    $telephone2 = secure($_POST["telephone2"]);
    



    $queryString = "INSERT INTO Users VALUES ('','{$email}','{$password}','{$firstname}','{$lastname}','{$address1}','{$city}','{$country}','{$postcode}',{$telephone1},{$telephone2},{$salt})";
    
    if($database->query($queryString)){
        $success = true;
        $message = "Account created successfully";
    }else
        $message =  $database->fetchConnection()->error;

    $database = null;
    $data = array("success"=>$success,"message"=>$message);
    echo json_encode($data);
?>
