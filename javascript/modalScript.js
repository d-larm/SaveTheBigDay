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