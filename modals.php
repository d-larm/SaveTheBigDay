
<!-- The Modal -->
<div id="myModal" class="modal">
   <div ng-app="login">
  		<div class="modal-content" style="width:50%;" >

	  		<div class="modal-header">
	  			<i class="fa fa-chevron-left" id="registerBack"></i>
	  			<i class="close fa fa-remove"></i>
	  			<h2 align=center id="signInTitle">Sign In</h2>
		    	
		    </div>

	    	<div class="modal-body">
			    <div id="register">
					<div class=registerContainer>
						<form ng-controller="register" method=POST>
							<div id="register">
								<div class=inputContainer>
									<div class = "row">
										<div class = "col-6">
											<input type=email style="background-color:{{color}}" placeholder="email" ng-model="email" class="signupInput">{{message}}
										</div>
										<div class = "col-6">
											<input type=password placeholder="password" ng-model="password" class="signupInput">{{passwordMessage}}
										</div>
									</div>
									
									<div class = "row">
										<div class = "col-6">
											<input type=text  ng-model="firstname" placeholder="first name"class="signupInput" >{{fNameMessage}}
										</div>
										<div class = "col-6">
											<input type=text  ng-model="lastname" placeholder="last name" class="signupInput" >{{lNameMessage}}
										</div>
									</div>
									
									<div class = "row">
										<div class = "col-6">
											<input type=text  ng-model="address1" placeholder="Address Line 1" class="signupInput" >{{address1}}
										</div>
										<div class = "col-6">
											<input type=text  ng-model="city" placeholder="City" class="signupInput" >{{city}}
										</div>
									</div>
									
									<div class = "row">
										<div class = "col-6">
											<input type=text  ng-model="country" placeholder="Country" class="signupInput" >{{country}}
										</div>
										<div class = "col-6">
											<input type=text  ng-model="postcode" placeholder="Postcode" class="signupInput" >{{postcode}}
										</div>
									</div>
									
									<div class = "row">
										<div class = "col-6">
											<input type=tel  ng-model="telephone1" placeholder="Telephone 1" class="signupInput" >{{telephone1}}
										</div>
										<div class = "col-6">
											<input type=tel  ng-model="telephone2" placeholder="Telephone 2" class="signupInput" >{{telephone2}}
										</div>
									</div>	
									
									<div class = "row">					
										<button class = "signUpButton" ng-click="validate()">Sign me up</button>
									</div>				
								</div>	
							</div>
						</form>
					</div>
				</div>
				<div id="login">
					<form class=form-group ng-controller="login" method=POST>
						<div class=loginContainer>
							<div class=row>
								<div class="col-9">
									<p><input class="loginInput" type=email style="background-color:{{color}}"  ng-model="email" placeholder="Username">{{message}}</p>
									<p><input class="loginInput" type=password  ng-model="password" placeholder="Password">{{passwordMessage}}</p>
									
								</div>
								<div class="col-3" style="padding:0 15px 0 15px;">
									<button class="chevButton" ng-click="login()" style= "transform: translateY(65%);"><i class="fa fa-chevron-right"></i></button>
								</div>
							</div>
						</div>
						<div class = "extra">
							<a href="#" style="text-decoration:none;color: white;float:left;" id="registerNow">Register</a>
							<a href="vendorUser.php" style="text-decoration:none;color: white;float:right;margin-right:1%;">Are you a vendor?</a>
						</div>
					</form>
					<br><br>
					<p align=center>Or alternatively sign in using:</p>
					<p><a href="#" id="facebookLogin" style="text-decoration:none;color: #aaaaaa;"><i class="fa fa-facebook-square" style="font-size:35pt;"></i></a></p>
				</div>
			</div>

		</div>	
	</div>
</div>
