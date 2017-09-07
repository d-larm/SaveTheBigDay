<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<Content-Type: text/html; charset=utf-8></Content-Type:>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
	<link rel="stylesheet" type="text/css" href="http://localhost/css/main.css">
	<script src="http://localhost/js/jquery-3.1.1.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<title>Home</title>
</head>
<body>
	<div ng-app="login">

		<form ng-controller="loginDetails" method=POST>
			<label>Username</label>
			<p><input type=email style="background-color:{{color}}" ng-model="email">{{message}}</p>
			<p><label>Password</label></p>
			<input type=text ng-model="password">
			<p><input type=button ng-click="validate()" name="login" value=login></p>
			<p>{{isEmail}}</p>
		</form>

	</div>

	<script>
		function validateEmail(email) {
    		var re = /\S+@\S+\.\S+/;
    		return re.test(email);
		}

		function check_POST(username,password){
			$.post("verifyLogin.php",function(data){
				value=JSON.parse(data)
				if(value == false)
					return false;
				else
					return true;
			}
		}

		var app=angular.module('login',[]);
		app.controller('loginDetails',function($scope){
			$scope.message="";
			$scope.validate = function(){
				$scope.isEmail = validateEmail($scope.email);
				if(validateEmail($scope.email)){
					$scope.color="green";
					$scope.message="";
					if(check_POST($scope.email,$scope.password)){
						window.location.href = "./home.php";
					}
				}else{
					$scope.color="red";
					$scope.message="	Enter a valid email address"
				}
			}
		});



	</script>












</body>
</html>