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
	if(isNaN(number) || !number ){
		scopeVar = "Enter a valid UK number (07XXXXXXXXX or 02XXXXXXXXXXX)";
	}
	else
		if(number.substring(0,2) != "07" && number.substring(0,2) != "02"){
			scopeVar = "Enter a valid UK number (07XXXXXXXXX or 02XXXXXXXXXXX)";
		}

	return scopeVar;
}

function validateURL(URL){

	scopeVar = "";
	if(!input)
		scopeVar="Please fill out the field";
	$.post("/php_scripts/checkURL.php",{URL: URL},function(exists){
		if(!exists)
			scopeVar = "Not a valid URL";

		alert(exists)
	});

	return scopeVar;
}