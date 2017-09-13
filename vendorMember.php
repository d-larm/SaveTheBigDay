<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css">
		<?php include "scripts.php" ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<title>Save The Big Day - Vendor Member</title>
	</head>
	<body style="background-color:white;">
		<?php include "gnavbar.php" ?>
		<div class=bodyContainer style="padding:0 100px 0 100px;">
			<h1>Create Vendor Page</h1>
			<div class=row style="border-top:1px solid black">
				<div class=col-2>
						<button class="logo-round" style="width:100%;height:200px;border-radius:50%;"> UPLOAD LOGO </button>
				</div>
				<div class=col-5>
					<form id="vendorPageForm">
						<label>Vendor Name</label>
						<p><input type=text class="vendorMemberInputLarge"></p>

						<label>Vendor Category</label>
						<p><input type=text class="vendorMemberInputLarge"></p>

						<label>Address</label>
						<p><input type=text class="vendorMemberInputLarge"></p>
						<p><input type=text class="vendorMemberInputLarge"></p>

						<label>Telephone</label><label>Telephone 2</label>
						<p><input type=text class="vendorMemberInputSmall"><input type=text class="vendorMemberInputSmall"></p>

						<label>Website</label><label>Email</label>
						<p><input type=text class="vendorMemberInputSmall"><input type=text class="vendorMemberInputSmall"></p>
					</form>
				</div>
				<div class=col-5>
					<label>Facebook</label>
					<p><input type=text form=vendorPageForm class="vendorMemberInputLarge"></p>

					<label>Instagram</label>
					<p><input type=text form=vendorPageForm class="vendorMemberInputLarge"></p>

					<label>Twitter</label>
					<p><input type=text form=vendorPageForm class="vendorMemberInputLarge"></p>

					<label>I confirm that I am the owner of this business</label><input type=checkbox>

					<p><button id="submitVendorButton" form=vendorPageForm>Submit Vendor</button></p>

				</div>
			</div>
			<div class="row">
				<div class=col-2>
				</div>
				<div class="col-10" style="height:auto;" >
					<form action="/php_scripts/uploadVendorPhotos.php" id="vendor-dropzone" class="dropzone" style="width:100%;height:400px;text-align:center;float:left;">
					</form>
				</div>
			</div>
		</div>
		<script>
			Dropzone.options.vendorDropzone = {
				autoProcessQueue: false,
				uploadMultiple: true,
				parallelUploads: 10,
				dictDefaultMessage: "Drop up to 20 files here to upload (7MB max)",
				paramName: "vendorfiles", // The name that will be used to transfer the file
				maxFilesize: 7, // MB
				maxFiles: 20,
				addRemoveLinks: true,
				dictRemoveFile: "X",
				init: function() {
					alert();
	                $.each(files, function (index, item) {
	                    this.emit('addedfile', 'uploading');
	                });
					//Gets the submit button
					var dropzone = this; //Gets the current dropzone
					$("#submitVendorButton").click(function(){
						dropzone.processQueue(); //Processes all images in the queue when submit button clicked
					});
				}
			};


			$(document).ready(function(){
				$("html").on("drop", function(event) {
				    event.preventDefault();  
				    event.stopPropagation();
				    alert("Dropped!");
				});
				$("html").on("dragover", function(event) {
					event.preventDefault();  
					event.stopPropagation();
					$(this).addClass('dragging');
				});

				$("html").on("dragleave", function(event) {
					event.preventDefault();  
					event.stopPropagation();
					$(this).removeClass('dragging');
				});

				$("#vendor-dropzone").submit(function(){
					alert("Submitted");
				})
				

			});

		</script>
	</body>
	
</html>