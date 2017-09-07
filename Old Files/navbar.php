<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<Content-Type: text/html; charset=utf-8>
	<link rel="stylesheet" href="css/navbar.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
<!-- The navigation bar -->
<nav class="navbar navbar-default" style="margin-bottom:0px;">
  <div class="container-fluid" style="background-color: #CDB8AE;">

    <div class="navbar-header">
    	<!-- The collapsible button that appears on smaller devices -->
    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
	    	<span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>   
	    </button>
	    <!-- Social network buttons on left of navbar -->
      <a class="navbar-brand" href="#"><i class="fa fa-twitter"></i></a>
      <a class="navbar-brand" href="#"><i class="fa fa-facebook-square"></i></a>
      <a class="navbar-brand" href="#"><i class="fa fa-instagram"></i></a>
    </div>

    <!-- Collapsible elements of the navbar which appear on the right on large devices and collapse on smaller devices -->
    <div class="collapse navbar-collapse" id="navbar">
	    <ul class="nav navbar-nav navbar-right" style="min-height:40px;">
	    	<!-- Places the profile element if the user session is still active, else it places the sign in element which allows the user to log in -->
	      	<?php
		      	session_start(); 
		      	if(isset($_SESSION["id"])){
		      		$name = strtoupper($_SESSION['name']);
		    		echo "<li class=dropdown><a class='dropdown-toggle' data-toggle='dropdown' style='color:white;' href='#' id=profile>{$name} <span class='caret'></span></a><ul class=dropdown-menu><li><a href='profile.php'>PROFILE</a></li><li id=messageNav><a href='#'>MESSAGES</a></li><li id=logoutNav><a href='#'>LOG OUT</a></li></ul></li>";
		      	}else
		    		echo "<li id=signIn><a href='#' style='color:white;' id=profile data-toggle='modal' data-target='#myModal'>SIGN IN</a></li>";
	    	?>
	    	<!-- The rest of the navbar elements -->
			<li><a href="#" style="color:white;">MEMBERSHIP</a></li>
			<li><a href="#" style="color:white;">WRITE A REVIEW</a></li>
			<li><a href="#" style="color:white;">ABOUT US</a></li>
			<li><a href="#" style="color:white;">CONTACT</a></li>
	    </ul>
	</div>
  </div> 
</nav>
<!-- The navbar navpill blocks which contain the main different categories -->
<ul class="nav nav-pills nav-justified">
  <li><a href="#">Venue</a></li>
  <li><a href="#">Photography</a></li>
  <li><a href="#">Catering</a></li>
  <li><a href="#">Decor</a></li>
  <li><a href="#">Beauty</a></li>
  <li><a href="#">Music</a></li>
</ul>

<?php include 'modals.php' ?>



<script>
$(document).ready(function(){
	// Get the modal
	var modal = $("#myModal");
	var register = false;

	// Get the button that opens the modal
	var btn = $("#signIn");

	// When the user clicks the button, open the modal 
	btn.click(function() {
		$("#register").hide();
		$("#login").show();
	    register=false;
	    $("#registerBack").hide();
	});

	//Switches to the registration modal when registration button clicked
	$("#registerNow").click(function(){
		$("#login").hide();
		$("#register").slideDown();
		register=true;
		$("#registerBack").show();
		
	});

	//Switches to the login modal when back button clicked
	$("#registerBack").click(function(){
		$("#register").hide();
		$("#login").slideDown();
		register=false;
		$(this).hide();
	});

	$("#logoutNav").click(function(){
		$.post("logOut.php",function(data){
			window.location.href = "./home.php";
		})
	})

	window.onclick = function(event) {
	    if (event.target == document.getElementById('myModal')) {
	        modal.fadeOut();
	    }
	}

	$('a').click(function(e){
		if($(this).attr('href') == "#")
    // Special stuff to do when this link is clicked...
    	e.preventDefault();
	});
});

</script>


<script>
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
			$.post("createUser.php",postData,function(data){
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
			$.post("verifyLogin.php",postData,function(data){
				returnData = JSON.parse(data);
				if(returnData["success"]){
					//Login successful
					alert("Login Successful");
					$(".close").first().trigger('click');
					$("#profile").text(returnData["name"].toUpperCase()).fadeIn();
					$("#profile").attr("href", "./profile.php")
				}else{
					//Login failed.
					alert("Username and/or password incorrect");
				}
			})
		}
	}
});
</script>
</body>


