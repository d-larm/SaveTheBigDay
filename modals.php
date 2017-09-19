
<!-- The Modal -->
<div id="myModal" class="modal">
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
									<input type=email style="background-color:{{color}}" placeholder="Email" ng-model="email" class="signupInput"><span class="formMessage">{{message}}</span>
								</div>
								<div class = "col-6">
									<input type=password placeholder="Password" ng-model="password" class="signupInput"><span class="formMessage">{{passwordMessage}}</span>
								</div>
							</div>
							
							<div class = "row">
								<div class = "col-6">
									<input type=text  ng-model="firstname" placeholder="First name"class="signupInput" ><span class="formMessage">{{fNameMessage}}</span>
								</div>
								<div class = "col-6">
									<input type=text  ng-model="lastname" placeholder="Last name" class="signupInput" ><span class="formMessage">{{lNameMessage}}</span>
								</div>
							</div>
							
							<div class = "row">
								<div class = "col-6">
									<input type=text  ng-model="address1" placeholder="Address Line 1" class="signupInput"><span class="formMessage">{{address1Message}}</span>
								</div>
								<div class = "col-6">
									<input type=text  ng-model="city" placeholder="City" class="signupInput" ><span class="formMessage">{{cityMessage}}</span>
								</div>
							</div>
							
							<div class = "row">
								<div class = "col-6">
									<input type=text  ng-model="country" placeholder="Country" class="signupInput" ><span class="formMessage">{{countryMessage}}</span>
								</div>
								<div class = "col-6">
									<input type=text  ng-model="postcode" placeholder="Postcode" class="signupInput" ><span class="formMessage">{{postcodeMessage}}</span>
								</div>
							</div>
							
							<div class = "row">
								<div class = "col-6">
									<input type=tel  ng-model="telephone1" placeholder="Telephone 1" class="signupInput" ><span class="formMessage">{{tel1Message}}</span>
								</div>
								<div class = "col-6">
									<input type=tel  ng-model="telephone2" placeholder="Telephone 2" class="signupInput" ><span class="formMessage">{{tel2Message}}</span>
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
							<p align=center><input class="loginInput" type=email style="background-color:{{color}}"  ng-model="email" placeholder="Username"><span class="formMessage">{{message}}</span></p>
							<p><input class="loginInput" type=password  ng-model="password" placeholder="Password"><span class="formMessage">{{passwordMessage}}</span></p>
						</div>
						<div class="col-3" style="padding:0 15px 0 15px;">
							<button class="chevButton" ng-click="login()" style= "transform: translateY(65%);"><i class="fa fa-chevron-right"></i></button>
						</div>
					</div>
				</div>
				<div class = "extra">
					<a href="#" style="text-decoration:none;color: white;float:left;" id="registerNow">Register</a>
					<a href="vendorMember.php" style="text-decoration:none;color: white;float:right;margin-right:1%;">Are you a vendor?</a>
				</div>
			</form>
			<br><br>
			<p align=center>Or alternatively sign in using:</p>
			<p><a href="#" id="facebookLogin" style="text-decoration:none;color: #aaaaaa;"><i class="fa fa-facebook-square" style="font-size:35pt;"></i></a></p>
		</div>
	</div>
</div>	
</div>

<div id="messageModal" class="modal">
	<div class="modal-content" style="width:50%;" >
  		<div class="modal-header">
  			<i class="close fa fa-remove"></i>
  			<h2 align=center>Messages</h2>
	    </div>

    	<div class="modal-body">
	    	<div class="row">
	    		<div id="messageNav">
	    			<div class="col-2">
		    			<ul>
		    				<li><a href="#" id="newMessageNav">New &emsp;<i class="fa fa-pencil-square-o"></i></a></li>
		    				<li><a href="#" id="unreadNav">Unread &emsp;<i class="fa fa-envelope"></i></a></li>
		    				<li><a href="#" id="inboxNav">Inbox &emsp;<i class="fa fa-inbox"></i></a></li>
		    				<li><a href="#" id="sentNav">Sent &emsp;<i class="fa fa-paper-plane-o"></i></a></li>
		    			</ul>
	    			</div>
	    		</div>
	    		<div class="col-10 inbox">
	    			<table>
	    				<thead>
	    					<th class="senderTitle">Sender</th>
	    					<th>Subject</th>
	    					<th>Time</th>
	    				</thead>
	    				<tbody class="messageList">

	    				</tbody>
	    			</table>
	    		</div>
	    		<div class="col-10 newMessage" style="display:none;">
	    			<p><input type=text placeholder="Send to..." class="sendInput"></p>
	    			<p><input type=text placeholder="Subject" class="subjectInput"></p>
	    			<p><textarea rows="10" cols="30" maxlength=300 placeholder="Message" class="messageInput"></textarea></p>
	    			<button class="chevButton sendMessage"><i class="fa fa-chevron-right"></i></button>
	    		</div>
	    	</div>
    	</div>   
	</div>
</div>


<script>
//Scripts for the messaging system
$(document).ready(function(){
	$("#inboxNav").click(function(){
		$(".newMessage").hide();
		$(".inbox").hide();
		$(".inbox").fadeIn();
		id = <?php
			if(isset($_SESSION['id'])){ 
				echo $_SESSION['id']; 
			}else{ 
				echo '-1';}
		?>
		
		postData = {
			id: id
		}
		$.post("/php_scripts/getUserMessagesReceived.php",postData,function(data){
			messages = JSON.parse(data);
			$(".messageList").empty();
			if(messages.length == 0)
				$(".messageList").append("<h1>No messages</h1>").fadeIn();
			else{
				for(i=0;i<messages.length;i++)
					if(messages[i]["Read"])
						$(".messageList").append("<tr class='readMessage'><td>"+messages[i]["Sender"]+"</td><td>"+messages[i]["Subject"].substring(0,20)+"</td><td>"+messages[i]["Timestamp"]+"</td></tr>").slideDown();
					else
						$(".messageList").append("<tr class='unreadMessage'><td>"+messages[i]["Sender"]+"</td><td>"+messages[i]["Subject"].substring(0,20)+"</td><td>"+messages[i]["Timestamp"]+"</td></tr>").slideDown();
			}
		});
	});

	$("#newMessageNav").click(function(){
		$(".inbox").hide();
		$(".newMessage").hide();
		$(".newMessage").fadeIn();
	});

	$("#unreadNav").click(function(){
		$(".newMessage").hide();
		$(".inbox").hide();
		$(".inbox").fadeIn();
		id = <?php
			if(isset($_SESSION['id'])){ 
				echo $_SESSION['id']; 
			}else{ 
				echo '-1';}
		?>

		postData = {
			id: id
		}
		$.post("/php_scripts/getUserMessagesReceived.php",postData,function(data){
			messages = JSON.parse(data);
			$(".messageList").empty();
			if(messages.length == 0)
				$(".messageList").append("<h1>No new messages</h1>").fadeIn();
			else{
				for(i=0;i<messages.length;i++)
					$(".messageList").append("<tr class='unreadMessage'><td>"+messages[i]["Sender"]+"</td><td>"+messages[i]["Subject"].substring(0,20)+"</td><td>"+messages[i]["Timestamp"]+"</td></tr>").slideDown();
			}
		});

	});

	$(".sendMessage").click(function(){

	})

});
</script>
