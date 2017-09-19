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

	return scopeVar;
}

function validateURL(URL){
	data = {
		url: URL
	}
	alert(String(URL))
	scopeVar = "";
	if(!URL)
		scopeVar="Please enter a URL into the field";
	else{
		// $.post("/php_scripts/checkURL.php",data,function(exists){
		// 	exists = JSON.parse(exists);
		// 	alert(exists)
		// 	if(!exists)
		// 		scopeVar = "Not a valid URL";

		// 	alert(exists)
		// });
		var pattern = new RegExp('^(https?:\/\/)?'+ // protocol
		    '((([a-z\d]([a-z\d-]*[a-z\d])*)\.)+[a-z]{2,}|'+ // domain name
		    '((\d{1,3}\.){3}\d{1,3}))'+ // OR ip (v4) address
		    '(\:\d+)?(\/[-a-z\d%_.~+]*)*'+ // port and path
		    '(\?[;&a-z\d%_.~+=-]*)?'+ // query string
		    '(\#[-a-z\d_]*)?$','i'
		); // fragment locater
	  if(!pattern.test(URL))
	    console.log("Please enter a valid URL.");
	}

	return scopeVar;
}