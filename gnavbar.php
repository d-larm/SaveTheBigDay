<div class = "navbar">
	<div class = "social">
		<?php include "socialButtons.php" ?>
	</div>
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

<?php include "modals.php" ?>

<script>
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
		
	});

	$(".close").click(function(){
		modal.slideUp();
	})

	//Switches to the login modal when back button clicked
	$("#registerBack").click(function(){
		$("#register").slideUp();
		$("#login").slideDown();
		$("#signInTitle").hide();
		$("#signInTitle").text(signInText);
		$("#signInTitle").fadeIn();
		register=false;
		$(this).css("visibility","hidden");

	});

	$(document).on("click","#logOut",function(){
		$.post("/php_scripts/logOut.php",function(data){
			swal("Logged Out","", "success").then((value)=>{
				location.reload();
			});
			
		})
	})

	window.onclick = function(event) {
	    if (event.target == document.getElementById('myModal')) {
	        modal.fadeOut();
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

	function validateEmail(email) {
		var re = /\S+@\S+\.\S+/;
		return re.test(email);
	}



	var app=angular.module('login',[]);
	app.controller('register',function($scope){
		$scope.title="Register"
		$scope.message="";
		$scope.passwordMessage = "";
		$scope.validate = function(){
			var emailValid = false;
			var passwordValid = false;
			if(validateEmail($scope.email)){
				$scope.color="green";
				$scope.message="";
				emailValid=true;
			}else{
				$scope.color="red";
				$scope.message="	Enter a valid email address";
			}
			if($scope.password != null){
				passwordValid = true;
				$scope.passwordMessage = "";
			}else
				$scope.passwordMessage = "		Do not leave password blank";

			if(emailValid && passwordValid){
				postData = {	email:$scope.email,password:$scope.password,
								firstname:$scope.firstname,lastname:$scope.lastname,
								address1:$scope.address1,city:$scope.city,country:$scope.country,
								postcode:$scope.postcode,telephone1:$scope.telephone1,telephone2:$scope.telephone2
				};
				$.post("/php_scripts/createUser.php",postData,function(data){
					alert(data)
					completed = JSON.parse(data);
					if(completed["success"]){
						alert("Account Created Successfully");
						close.trigger('click');
					}else{
						alert("Some fields are incorrect");
					}
				});
			}	
		}
	});

	app.controller('login',function($scope){
		$scope.title="Login";
		$scope.message="";
		$scope.login = function(){
			var emailValid = false;
			var passwordValid = false;
			if(validateEmail($scope.email)){
				$scope.message="";
				emailValid=true;
			}else{
				$scope.color="red";
				$scope.message="	Enter a valid email address";
			}
			if($scope.password != null){
				passwordValid = true;
				$scope.passwordMessage = "";
			}else
				$scope.passwordMessage = "		Do not leave password blank";

			if(emailValid && passwordValid){
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
						alert("Username and/or password incorrect");
					}
				})
			}
		}
	});
</script>
