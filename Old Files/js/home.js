$(document).ready(function(){
// Get the modal
var modal = $("#myModal");
var register = false;

// Get the button that opens the modal
var btn = $("#signIn");

// Get the <span> element that closes the modal
var span = $(".close").first();

// When the user clicks the button, open the modal 
btn.click(function() {
	$("#register").hide();
	$("#login").show();
    modal.fadeIn();
    register=false;
});

// When the user clicks on <span> (x), close the modal
span.click( function() {
    modal.fadeOut();
});

$("#registerNow").click(function(){
	$("#login").hide();
	$("#register").slideDown();
	register=true;
	
})

$("#registerBack").click(function(){
	$("#register").hide();
	$("#login").slideDown();
	
	register=false;
})

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == document.getElementById('myModal')) {
        modal.fadeOut();
    }
}
});
function validateEmail(email) {
		var re = /\S+@\S+\.\S+/;
		return re.test(email);
	}

	function checkCredentials(username,password){
		$.post("createUser.php",function(data){
			value=JSON.parse(data)
			if(value == false)
				return false;
			else
				return true;
		});
	}

	var app=angular.module(`login`,[]);
	app.controller(`register`,function($scope){
		$scope.title="Register"
		$scope.message="";
		$scope.validate = function(){
			$scope.isEmail = validateEmail($scope.email);
			if(validateEmail($scope.email)){
				$scope.color="green";
				$scope.message="";
				if(checkCredentials($scope.email,$scope.password)){
					window.location.href = "./home.php";
				}
			}else{
				$scope.color="red";
				$scope.message="	Enter a valid email address"
			}
		}
	});

	app.controller(`login`,function($scope){
		$scope.title="Login";
		$scope.message="";
		$scope.validate = function(){
			$scope.isEmail = validateEmail($scope.email);
			if(validateEmail($scope.email)){
				$scope.color="green";
				$scope.message="";
				if(checkCredentials($scope.email,$scope.password)){
					window.location.href = "./home.php";
				}
			}else{
				$scope.color="red";
				$scope.message="	Enter a valid email address"
			}
		}
	});
	app.controller('title',function($scope){
		$scope.title="Login";
		if(register)
			$scope.title="Register";
		else
			$scope.title="Login";
	})
