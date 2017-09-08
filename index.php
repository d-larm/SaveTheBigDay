<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
		<?php include "scripts.php" ?>
		<link rel="stylesheet" href="css/style.css">
		<title>Save The Big Day - Home</title>
	</head>
	<body>
		<?php include "gnavbar.php" ?>
		<div class = "logoSection"><img src="img/stbdLogo.png" alt="Logo" style="width:320px"></div>
		<div class = "searchSection">
			You've found Mr.Right, let us find you the right vendor
			<div class="searchContainer">
				<div class="row search">
					<div class="col-9">				
						<input type="text" id="tagInput" class="searchTerm1" placeholder= "Search by tag..." >
					</div>
					<div class="col-2">
					<input type="text" id="postcodeInput" class="searchTerm2" placeholder="SE22 9JB">
					</div>
					<div class="col-1">
					<button type="submit" class="chevButton" style= "transform: translate(-5px, -5px);" ng-click="validate()" id="submitSearch"><i class="fa fa-chevron-right";></i></button>
					</button>
					</div>
					<div id="tagContainer" class="tagCo">
					</div>	
				</div>
			</div>
		</div>

		<div class = "aboutSection">
			<h1>About Us</h1>
			<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vulputate risus a turpis feugiat, et
			pretium diam sollicitudin. Quisque aliquet est vel ligula eleifend, id faucibus odio feugiat. Ut lectus
			neque, tempus convallis enim a, elementum bibendum quam. Donec consectetur maximus rhoncus.
			Nullam posuere ligula nulla, sit amet sagittis nulla cursus quis. Aliquam id leo leo. Proin in felis viverra,
			aliquet ex ac, condimentum purus. Maecenas imperdiet finibus euismod.
			</p>
			
			<div class = "logoSection2">
				<div class = "social2">
					<?php include "socialButtonsDark.php" ?>
				</div>
			</div>
			
		</div>
		
		<div class = "contactSection">
			<div class = "mSection"> <img src="img/google-maps.jpg" alt="map" style="width:800px;height:500x;float:left;"> </div> 
			<div class = "cSection">
				<h1>
					Contact
				</h1>
					<p>
						We are here to help!
						Send any questions our
						way at:
						support@stbd.com
					</p>	
				<div class = "social3">
					<?php include "socialButtons2.php" ?>
				</div>					
			</div> 		
		</div>
		
		<div class = "footer">	
			<div class = "infoSide">
			<table>
			  <tr>
				<td>HOME</td>
				<td>SIGN IN</td>
				<td>VENDORS A-Z</td>
			  </tr>
			  <tr>
				<td>ABOUT US</td>
				<td>MEMBERSHIP</td>
				<td>CATEGORIES</td>
			  </tr>
			  <tr>
				<td>CONTACT</td>
				<td>WRITE A REVIEW</td>
			</table>
			
			
			<p>
			SUPPORT@STBD.COM
			</p>
			<div class = "infoBox">
				SAVE THE BIG DAY IS REGISTERED
				LIMITED COMPANY 08XXXXX
			</div>
		</div>	
			<div class = "logoSide">
				<img src="img/stbdLogo2.png" alt="Logo2" style="width:520px; transform: translate(350px, -140px);">
			</div>
				
		</div>
		<script src="javascript/tagList.js" type="text/javascript"></script>
		<script>
		$(document).ready(function(){
			//Selects the category from the dropdown when an option is clicked
			var location = "";
			$(".searchTerm2").on('input', function(){
				location = $(this).val();
				$(this).val(location.toUpperCase());
				$("input[name=postcode]").val(location);
			})

			$("#submitSearch").click(function(){
				tags = getTags();
				tagstring="";
				if(tags.length > 0){
					tagstring="";
					//Parses the tags into a url string to be sent as url parameters
					for(i=0;i<tags.length;i++){
						tagstring += "#"+encodeURIComponent(tags[i].trim());
					}
					if(location != "")
						window.location.href = "./vendors.php?tags="+tagstring+"&postcode="+location.replace(/\s+/g, '');
					else
						swal("Can not start search","Please enter postcode", "error");
					
				}else
					swal("Can not start search","Please enter tags to search with", "error");

				
			});
			$('a').click(function(e){
				if($(this).attr('href') == "#")
		    // Special stuff to do when this link is clicked...
		    	e.preventDefault();
			});
			
		});
		</script>
	</body>
	
</html>