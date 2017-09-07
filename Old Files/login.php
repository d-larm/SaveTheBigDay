<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<Content-Type: text/html; charset=utf-8></Content-Type:>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
	<link rel="stylesheet" type="text/css" href="http://localhost/css/main.css">
	<script src="http://localhost/js/jquery-3.1.1.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<title>Login</title>
	
	</script>
</head>
<body>

	<!-- Code to login using facebook

	<script language="javascript">
		function win(add,w,h)
		{

		window.open(add,"","width="+w+",height="+h+",location=0,directories=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1,top=5,left=5");
		window.location.reload();
		}
	<h1>Click to open link in new window</h1>
	<ul>
	  <li><a href="#" class="Menu">Account Master</a>
	    <ul>
	      <li><a href="https://www.facebook.com/v2.10/dialog/oauth?client_id=261987140964151&redirect_uri=https://www.google.co.uk" value="new.htm" target="_blank" onclick="win(this.href,600,450)">New</a></li>
	      <li><a href="mod.html" value="mod.html" target="_blank" onclick="win(this.href,600,500)" >Modify</a></li>
	      <li><a href="del.html" value="del.html" target="_blank" onclick="win(this.href,600,500)">Delete</a></li>
	      <li><a href="view.html" value="view.html" target="_blank" onclick="win(this.href,600,500)">View</a></li>
	    </ul>
	  </li>
	</ul>
	-->
	<div ng-app="login">

		<form ng-controller="loginDetails" method=POST>
			<label>Username</label>
			<p><input type=email style="background-color:{{color}}" ng-model="email">{{message}}</p>
			<p><label>Password</label></p>
			<input type=password ng-model="password">
			<p><input type=button ng-click="validate()" name="login" value=login></p>
			<p>{{isEmail}}</p>
		</form>

	</div> 


	<script>
		function validateEmail(email) {
    		var re = /\S+@\S+\.\S+/;
    		return re.test(email);
		}

		function checkCredentials(username,password){
			$.post("verifyLogin.php",function(data){
				value=JSON.parse(data)
				if(value == false)
					return false;
				else
					return true;
			});
		}

		var app=angular.module(`login`,[]);
		app.controller(`loginDetails`,function($scope){
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



	</script>

</body>
</html>