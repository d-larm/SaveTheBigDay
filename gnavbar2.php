<div class = "navbar">
	<div class = "social" id ="socialMenu" style="padding-left:100px; padding-top:20px;">
		<img src="img/companyLogo2.png" alt="companyLogo" style="width:80px;" class="sbtn">
	</div>
	<div id="navbarButtons">
	<div class="navbarButton">WRITE A REVIEW</div>
	<div class="navbarButton">MEMBERSHIP</div>
	<?php
      	session_start(); 
      	if(isset($_SESSION["id"])){
      		$name = strtoupper($_SESSION['name']);
    		echo "<div class='navbarButton' id='profile'>{$name} <i class='fa fa-chevron-down' aria-hidden='true'></i><div id='profileDropDown' class='dropdown-content'><a href='profile.php' id='profileLink'>PROFILE</a><a href='#' id='messages'>MESSAGES</a><a href='#' id='logOut'>LOG OUT</a></div></div>";
      	}else
    		echo "<div class='navbarButton' id='signIn'>SIGN IN</div>";
	?>
</div>
	<div id = "menuButton" class = "navbarButton">
		&#9776;
	</div>
</div>

<?php include "modals.php" ?>
<script src="/javascript/validateInputs.js" type=text/javascript></script>
<script src="/javascript/modalScript.js"></script>
<script src="/javascript/messageModalScript.js"></script>
<script src="/javascript/loginScript.js"> </script>