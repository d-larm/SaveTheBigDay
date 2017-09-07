$(document).ready(function(){
	$.ajaxSetup({ cache: true });
  	$.getScript('//connect.facebook.net/en_US/sdk.js', function(){
	    FB.init({
	      appId: app_ID,
	      version: 'v2.7' // or v2.1, v2.2, v2.3, ...
	    });     
	    $('#fblogin,#feedbutton').removeAttr('disabled');
	    FB.getLoginStatus(function(response){
	    	if(response.status === 'connected')
	    		facebookLogin(response);
	    	else
	    		ocument.getElementById('status').innerHTML = 'Please log into this app.';
	    });
  	});
});