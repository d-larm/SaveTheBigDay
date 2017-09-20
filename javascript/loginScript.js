//Login script for the login modal

	var app=angular.module('app',[]);
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