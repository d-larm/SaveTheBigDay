<?php session_start(); ?>
<?php

	if(!isset($_SESSION["id"]) or $_SESSION["logged"] != 1){
		$_SESSION = array();
		if (ini_get("session.use_cookies")) {
    		$params = session_get_cookie_params();
    		setcookie(session_name(), ``, time() - 42000,
       			$params["path"], $params["domain"],
        		$params["secure"], $params["httponly"]
    		);
		}
		header("Location: home.php"); //Checks if the session token is expired and redirects to home page if true
	}
?>
