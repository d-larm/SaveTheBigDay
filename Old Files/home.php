<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<Content-Type: text/html; charset=utf-8>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
	<link rel="stylesheet" href="css/home.css">
	<title>Home</title>
</head>
<body>
<?php include "navbarHome.php" ?>

<!-- Save the Big Day full width logo -->
<div class=container>
	<div class=jumbotron style="padding:100px;text-align:center;background-color:rgba(0, 0, 0, 0);color:white">
		<h1>Save The Big Day</h1>
	</div>
</div>

<div class=page-header></div>

<!-- Jumbo full width text -->
<div class=jumbotron style="text-align:center;background-color:rgba(0, 0, 0, 0);color:white;padding-left:0;">
	<p style="font-size:38pt;">You’ve found Mr. Right, let us find you the right vendor</p>

</div>

<!-- Form to search for vendors -->
<div class="container search" style="background-color:rgba(0,0,0,0.5); padding:30px; width:100%">
	<div class="row">
		<!-- Column containing the category drop down list -->
		<div class="col-sm-8">
		    <div class=dropdown>
			    <button style="height:60px;background-color:white;color:grey;font-size:20pt;width:100%;" class="form-control text-left" type="text" dropdown-toggle aria-expanded="false" data-toggle="dropdown" id=chooseCategory><i class="glyphicon glyphicon-search"></i>  Search by Category</button>
		  		<ul class="dropdown-menu" style="width:100%;">
		  			 <li>
		                <div class="row">
		                    <ul class="list-unstyled col-md-4 ">
		                        <li><a href="#"><span class="glyphicon glyphicon-play-circle"></span><span class=category>Videography</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-gift"></span><span class=category> Gifting</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-camera"></span><span class=category> Photography</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-cd"></span><span class=category> DJ</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-gift"></span><span class=category> Menswear</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-camera"></span><span class=category> Venue</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-play-circle"></span><span class=category> Wedding Planners</span></a></li>
		                    	<li><a href="#"><span class="glyphicon glyphicon-camera"></span><span class=category> Flowers</span></a></li>
		                    </ul>
		                    <ul class="list-unstyled col-md-4">
		                        <li><a href="#"><span class="glyphicon glyphicon-play-circle"></span><span class=category> Wedding Cakes</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-gift"></span><span class=category> Rentals</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-camera"></span><span class=category> Jewellers</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-play-circle"></span><span class=category> Sound</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-gift"></span><span class=category> Decor</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-camera"></span><span class=category> Hair</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-gift"></span><span class=category> Lighting</span></a></li>
		                       
		                    </ul>
		                    <ul class="list-unstyled col-md-4">
		                        <li><a href="#"><span class="glyphicon glyphicon-play-circle"></span><span class=category> Wedding Planners</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-gift"></span><span class=category> Catering</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-camera"></span><span class=category> Bands and Music</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-play-circle"></span><span class=category> Transport</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-gift"></span><span class=category> Stationary</span></a></li>
		                        <li><a href="#"><span class="glyphicon glyphicon-camera"></span><span class=category> Dresses</span></a></li>
		                         <li><a href="#"><span class="glyphicon glyphicon-camera"></span><span class=category> Master of Ceremonies</span></a></li>
		                    </ul>
		                </div>
		 			</li>
		  		</ul>
		  	</div>
		</div>
		<!-- Column contains postcode input -->
		<div class="col-sm-2">
			<input style="height:60px;font-size:15pt;" id=location type="text" class="form-control" placeholder="SE10 9DE" aria-expanded="false">
		</div>
		<!-- Column contains the go button which begins the search -->
		<div class="col-sm-2 center-block text-center">
			<button id="startSearch"><span class="glyphicon glyphicon-menu-right"></span></button>
		</div>
	</div>
</div>
<form id=searchForm action="vendors.php" method=POST>
	<input type=hidden name=category>
	<input type=hidden name=postcode>
</form>

<div class="alert alert-warning alert-dismissible show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
</div>

<script>
$(document).ready(function(){
	//Selects the category from the dropdown when an option is clicked
	var category = "";
	var location = "";
	$("#location").on('input', function(){
		location = $(this).val();
		$("input[name=postcode]").val(location);
	})

	$(".category").click(function(){
		$("#chooseCategory").text($(this).text());
		category = $(this).text();
		$("input[name=category]").val(category);
	});
	$("#chooseCategory").click(function(){
		$("#chooseCategory").html("<i class='glyphicon glyphicon-search'></i> Search by Category");
		category = "";
		$("input[name=category]").val(category);
	});

	$("#startSearch").click(function(){
		if(category != "")
			$("#searchForm").submit();
		else
			$(".alert").show();
		// window.location.href = "./vendors.php?category="+category+"&location="+location;
	})
	$('a').click(function(e){
		if($(this).attr('href') == "#")
    // Special stuff to do when this link is clicked...
    	e.preventDefault();
	});
});
</script>
</body>
</html>