$(document).ready(function(){
//Scripts for the messaging modal
	window.onclick = function(event) {
	    if (event.target == document.getElementById('messageModal')) {
	        $("#messageModal").fadeOut();
	    }
	}

	$(document).on('click','#messages',function(){
		$("#messageModal").fadeIn();
	});

});