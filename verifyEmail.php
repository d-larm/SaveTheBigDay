<?php session_start(); ?>
<?php include "database.php" ?>
<?php include "securetext.php" ?>
<?php
 
// URL which should be requested
$url = 'https://api.hippoapi.com/v3/more/json';
 
$apikey = 'FB658D8C'; // API Key
 
$email = $_POST['email']; // Email to test
 
// jSON String for request
$url .= "/$apikey/$email";
 
// Initializing curl
$ch = curl_init( $url );
 
if($ch == false) {
 	die ("Curl failed!");
} else {
 
  // Configuring curl options
  $options = array(
  	CURLOPT_RETURNTRANSFER => true,
  	CURLOPT_HTTPHEADER => array('Content-type: application/json')
  );
   
  // Setting curl options
  curl_setopt_array( $ch, $options );
   
  // Getting results
  $result = curl_exec($ch); // Getting jSON result string
   
  // display JSON data
  echo "$result";
   
}
 
?>