<div class = "navbar">
	<div class = "social" id ="socialMenu">
		<?php include "socialButtons.php" ?>
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

<script>
//Modal scripts for the login modal interface
$(document).ready(function(){
	// Get the modal
	var modal = $("#myModal");
	var register = false;
	var signInText="SIGN IN";
	var registerText="SIGN UP";

	// Get the button that opens the modal

	$(document).on("click","#profile",function(){
		if (!$("#profileDropDown").is(':visible')){
			$("#profileDropDown").slideDown();
		}else{
			$("#profileDropDown").slideUp();
		}
	});

	// When the user clicks the button, open the modal 
	$(document).on("click","#signIn",function(){
		modal.fadeIn();
		$("#register").hide();
		$("#login").show();
		$("#signInTitle").hide();
		$("#signInTitle").text(signInText);
		$("#signInTitle").fadeIn();
	    register=false;
	    $("#registerBack").css("visibility","hidden");

	});

	//Switches to the registration modal when registration button clicked
	$("#registerNow").click(function(){
		$("#login").slideUp();
		$("#register").slideDown();
		$("#signInTitle").hide();
		$("#signInTitle").text(registerText);
		$("#signInTitle").fadeIn();
		register=true;
		$("#registerBack").show();
		$("#registerBack").css("visibility","visible");
		$('#register').find('input').val('');
		$('.formMessage').hide();	
	});

	$(".close").click(function(){
		$(".modal").slideUp();
		$('.formMessage').fadeOut();	
	});

	//Switches to the login modal when back button clicked
	$("#registerBack").click(function(){
		$("#register").slideUp();
		$("#login").slideDown();
		$("#signInTitle").hide();
		$("#signInTitle").text(signInText);
		$("#signInTitle").fadeIn();
		register=false;
		$(this).css("visibility","hidden");
		$('.formMessage').fadeOut();	
	});

	$(".signUpButton").click(function(){
		$('.formMessage').fadeIn('slow');	
	})

	$(document).on("click","#logOut",function(){
		$.post("/php_scripts/logOut.php",function(data){
			swal("Logged Out","", "success").then((value)=>{
				location.reload();
			});	
		});
	});

	window.onclick = function(event) {
	    if (event.target == document.getElementById('myModal')) {
	        modal.fadeOut();
	        $('.formMessage').fadeOut();	
	    }
	    if(event.target != document.getElementById('profile'))
	    	$("#profileDropDown").slideUp();
		
	}

	$('a').click(function(e){
		if($(this).attr('href') == "#")
    // Special stuff to do when this link is clicked...
    	e.preventDefault();
	});
});
</script>

<script>
$(document).ready(function(){
//Scripts for the messaging modal
	window.onclick = function(event) {
	    if (event.target == document.getElementById('messageModal')) {
	        $("#messageModal").fadeOut();
	    }
	}

	$(document).on('click','#messages',function(){
		$("#messageModal").fadeIn();
	});

});

</script>


<script>
//Login script for the login modal
	function validateEmail(email) {
		scopeVar = "";
		var re = /\S+@\S+\.\S+/;
		if(!re.test(email))
			scopeVar="Enter a valid email address";

		return scopeVar;
	}

	function validatePassword(password){
		scopeVar = "";
		if(!password)
			scopeVar = "Enter a password";
		else
			if(password.length < 8)
				scopeVar = "Password is too short (At least 8 characters)";

		return scopeVar;
	}

	function validatePostcode(postcode){
		scopeVar = "";

		if(postcode){
			string = postcode.replace(/\s+/g, '');
			if(string.length > 7 && string.length < 5)
				scopeVar = "Enter a valid postcode";
		}else
			scopeVar = "Enter a valid postcode";

		return scopeVar;
	}

	function validateInput(input){
		scopeVar = "";
		if(!input)
			scopeVar="Please fill out the field";

		return scopeVar;
	}

	function validateNumber(number){
		scopeVar = "";
		if(isNaN(number) || !number ){
			scopeVar = "Enter a valid UK number (07XXXXXXXXX or 02XXXXXXXXXXX)";
		}
		else
			if(number.substring(0,2) != "07" && number.substring(0,2) != "02"){
				alert(number.substring(0,2));
				scopeVar = "Enter a valid UK number (07XXXXXXXXX or 02XXXXXXXXXXX)";
			}

		return scopeVar;
	}

	var app=angular.module('login',[]);
	app.controller('register',function($scope){
		$scope.title="Register"
		$scope.validate = function(){
			
			$scope.message = validateEmail(($scope.email));
			$scope.passwordMessage = validatePassword(($scope.password));
			$scope.fNameMessage = validateInput(($scope.firstname));
			$scope.lNameMessage = validateInput(($scope.lastname));
			$scope.address1Message = validateInput(($scope.address1));
			$scope.cityMessage = validateInput(($scope.city));
			$scope.countryMessage = validateInput(($scope.country));
			$scope.postcodeMessage = validatePostcode(($scope.postcode));
			$scope.tel1Message = validateNumber(($scope.telephone1));
			$scope.tel2Message = validateNumber(($scope.telephone2));

						if($scope.message+$scope.passwordMessage+$scope.fNameMessage+$scope.lNameMessage+$scope.address1Message+$scope.cityMessage+$scope.postcodeMessage+$scope.tel1Message == ""){
				postData = {	email:$scope.email,password:$scope.password,
								firstname:$scope.firstname,lastname:$scope.lastname,
								address1:$scope.address1,city:$scope.city,country:$scope.country,
								postcode:$scope.postcode,telephone1:$scope.telephone1,telephone2:$scope.telephone2
				};
				$.post("/php_scripts/createUser.php",postData,function(data){
					completed = JSON.parse(data);
					if(completed["success"]){
						swal("Done","Account created successfully", "success").then((value)=>{
							$(".close").trigger('click');
						});
						
					}else{
						swal("Could not create account","Looks like a user already exits under this email", "error");
					}
				});
			}else{
				swal("Hold Up","Some fields are not correctly filled in", "warning");
			}
		}
	});

	app.controller('login',function($scope){
		$scope.title="Login";
		$scope.login = function(){
			$scope.message = validateEmail(($scope.email));
			$scope.passwordMessage = validatePassword($scope.password);
			if($scope.message+$scope.passwordMessage == ""){
				postData = {
					email : $scope.email,
					password : $scope.password
				}
				$.post("/php_scripts/verifyLogin.php",postData,function(data){
					returnData = JSON.parse(data);
					if(returnData["success"]){
						//Login successful
						swal("Logged In","", "success").then((valaue)=>{
							$(".close").first().trigger('click');
							$("#signIn").attr('id','profile');
							$("#profile").empty();
							$("#profile").html(returnData["name"].toUpperCase()+" <i class='fa fa-chevron-down' aria-hidden='true'></i><div id='profileDropDown' class='dropdown-content'><a href='profile.php' id='profileLink'>PROFILE</a><a href='#' id='messages'>MESSAGES</a><a href='#' id='logOut'>LOG OUT</a></div>");
							btn = null;
						});
					}else{
						//Login failed.
						swal("Login Failed","Username and/or password incorrect or doesnt exist", "error");
					}
				})
			}else{
				$('.formMessage').fadeIn();	
			}
		}
	});
</script>
