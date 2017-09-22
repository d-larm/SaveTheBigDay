<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
		<?php include "scripts.php" ?>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/style2.css">
		<link rel="stylesheet" href="css/gridCollapsible.css">
		<title>Save The Big Day - Search</title>
	</head>
	<body style="background-color:white" ng-app="app">
		<?php include "gnavbar2.php" ?>
		<div class="container">
			<div class="row">
				<div class ="col-4">Wedding Venue</div>
				<div class = "col-8">is this your business</div>
			</div>
			<div class="row">
				<div class="col-3">
					<h1 align=center>Tags</h1>
					<h2> <!--Prints out the tags inputted in the search !-->
						<?php
							if (isset($_GET['tags'])) {
						        $tags = explode("-",$_GET["tags"]);
						        foreach($tags as $tag)
						        	echo "<div class='tags' style='background-color:grey'>{$tag}</div>";
						    }else{
						        echo "Tags not set";
						    }
						?>
					</h2>
				</div>
				<div class=vendorPageList>
					<div class="col-3">
						<div class="vendorElement" style="padding:10px;border:1px solid grey;height:auto;min-height:400px;">
							<img class="vendorImage" src="/img/fbLogoDark.png" style="width:100%;height:auto;">
							<h2 class="vendorTitle">This is a vendor element</h2>
							<p class="vendorText">This is a well thought message to the people of the world about how moist joseph is</p>
						</div>
					</div>
				</div>
				

			</div>
		</div>
	</body>
	<script>
		data =<?php
			$tags = $_GET["tags"];
			$location = $_GET["postcode"];

			database = new Database();
			$data = array();
			foreach($tags as $tag){
				$query = $database->query("SELECT * FROM VendorPages WHERE tags LIKE '%{$tag}%'");
				while(($page = mysqli_fetch_assoc($query))){
					array_push($data,$page); //Pushes page elements that have matching tag to array
			    }
			}	
		    echo json_encode(array_unique($data)); //Returrns an array where all pages are unique
		?>
		for(i=0;i<data.length;i++){
			$(".vendorPageList").append("<div class=col-3><div class=vendorElement style='padding:10px;border:1px solid grey;height:auto;min-height:400px;'>");
			$(".vendorPageList").append("<img class='vendorImage' src='/img/"+data[i]["VendorID"]+"/v/v(0).png' style='width:100%;height:auto;'>");
			$(".vendorPageList").append("<h2 class=vendorTitle>"+data[i]["Name"]+"</h2>");
			$(".vendorPageList").append("<p class=vendorText>"+data[i]["Content"].substring(0,25)+"</p>");
		}
		
	</script>
	
</html>