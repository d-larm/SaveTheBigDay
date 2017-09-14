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
					<label>Vendor Name</label>
					<p><input type=text name="name" form="vendor-dropzone" class="vendorMemberInputLarge"></p>

					<label>Vendor Category</label>
					<p><input type=text name="category" form="vendor-dropzone" class="vendorMemberInputLarge"></p>

					<label>Additional tags</label>
					<p><input type=text name="tags" form="vendor-dropzone" class="vendorMemberInputLarge"></p>

					<label>Address</label>
					<p><input type=text name="address1" form="vendor-dropzone" class="vendorMemberInputLarge"></p>
					<p><input type=text name="address2" form="vendor-dropzone" class="vendorMemberInputLarge"></p>

					<label>City</label>
					<p><input type=text name="city" form="vendor-dropzone" class="vendorMemberInputLarge"></p>
					<p><input type=text name="postcode" form="vendor-dropzone" class="vendorMemberInputSmall"><label> POSTCODE</label>

					<p><label>Telephone</label><label>Telephone 2</label></p>
					<p><input type=text name="telephone1" form="vendor-dropzone" class="vendorMemberInputSmall"><input type=text name="telephone2" form="vendor-dropzone" class="vendorMemberInputSmall"></p>

					<label>Website</label><label>Email</label>
					<p><input type=text name="website" form="vendor-dropzone" class="vendorMemberInputSmall"><input type=text name="email" form="vendor-dropzone" class="vendorMemberInputSmall"></p>
				</div>
				<div class=col-5>
					<label>Facebook</label>
					<p><input type=text name=facebook form="vendor-dropzone" class="vendorMemberInputLarge"></p>

					<label>Instagram</label>
					<p><input type=text name=instagram form="vendor-dropzone" class="vendorMemberInputLarge"></p>

					<label>Twitter</label>
					<p><input type=text name=twitter form="vendor-dropzone" class="vendorMemberInputLarge"></p>

					<label>I confirm that I am the owner of this business</label><input name=isOwner form=vendor-dropzone type=checkbox>

					<p><button id="submitVendorButton" form=vendor-dropzone>Submit Vendor</button></p>

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
				parallelUploads: 20,
				dictDefaultMessage: "Drop up to 20 files here to upload (7MB max)",
				paramName: "vendorfiles", // The name that will be used to transfer the file
				maxFilesize: 7, // MB
				maxFiles: 20,
				acceptedFiles: "image/*",
				addRemoveLinks: true,
				dictRemoveFile: "Remove",
				init: function() {
					//Gets the submit button
					var dropzone = this;
					$("#submitVendorButton").click(function(){
						dropzone.processQueue(); //Processes all images in the queue when submit button clicked
						event.preventDefault();  
				  	  	event.stopPropagation();
				  	  // 	var url = $("#vendor-dropzone").attr("action");
    					// var formData = $("#vendor-dropzone").serializeArray();
    					// console.log(formData);
    					
					});
					this.on("error",function(file){
						if(file.type != "image/*"){
							swal("Cannot add file","File is not an image", "error");
							dropzone.removeFile(file);
						}

					});
					this.on("sendingmultiple",function(file,xhr,formData){
						$("input[form=vendor-dropzone]").each(function(){
							if($(this).attr("type") != "checkbox")
								formData.append($(this).attr("name"),$(this).val());
							else
								formData.append($(this).attr("name"),$(this).is(":checked"));
						});
						
						// formData = $("#vendor-dropzone").serializeArray();
						console.log(formData);

					});
					this.on("addedfile",function(file){
						if(file.type != "image/png" && file.type != "image/jpeg" && file.type != "image/jpg"){
							swal("Cannot add file","File is not an image", "error");
							dropzone.removeFile(file);
						}
						if (this.files.length > 1) {
						   for (i = 0; i < this.files.length-1; i++) {
								if(this.files[i].name === file.name && this.files[i].size === file.size){
									swal("Cannot add file","File already added", "error");
									dropzone.removeFile(file);
								}
						    }
						}
					});
					this.on("queuecomplete", function(file, xhr){
               			alert(file.xhr.response);
            		})

					// this.on("queuecomplete",function(file){
					// 	swal("Complete","", "success");
					// });
					this.on("maxfilesexceeded",function(file){
						swal("Cannot add image","Max number of photos reached", "error");
						dropzone.removeFile(file);
					});
				}
			};


			$(document).ready(function(){
				$("html").on("drop", function(event) {
				    event.preventDefault();  
				    event.stopPropagation();
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



			});

		</script>
	</body>
	
</html>