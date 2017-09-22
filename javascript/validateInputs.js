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
	number = String(number)
	if(isNaN(number) || !number ){
		scopeVar = "Enter a valid UK number";
	}
	else
		if(number.length < 11){
			scopeVar = "Enter a valid UK number";
			
		}
		alert(number)

	return scopeVar;
}

function validateURL(URL){
	URL=String(URL);
	data = {
		url: URL
	}
	scopeVar = "";
	if(!URL)
		scopeVar="Please enter a URL into the field";
	else
		$.ajax({
			type: 'POST',
			url: "/php_scripts/checkURL.php",
			data: data,
			success: function(exists){
						if(JSON.parse(exists) === false){
							scopeVar = "Please enter a valid URL";
						}
					 },
			async: false
		});

	return scopeVar;
}