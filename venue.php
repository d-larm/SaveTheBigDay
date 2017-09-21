<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
		<?php include "scripts.php" ?>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/style2.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<title>Save The Big Day - Home</title>
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
					<h2><?php
							if (isset($_GET['tags'])) {
						        $tags = explode("-",$_GET["tags"]);
						        foreach($tags as $tag)
						        	echo "<div class='tags' style='background-color:grey'>{$tag}</div>";
						    }else{
						        echo "Tags not set";
						    }



						?></h2>
				</div>
		</div>
	</body>
	
</html>