<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css">
		<?php include "scripts.php" ?>
		<link rel="stylesheet" href="css/gridCollapsible.css">
		<title>Save The Big Day - Vendor Member</title>

	</head>
	<body style="background-color:white;" ng-app="app">

		<?php include "gnavbar.php" ?>
		<div class=bodyContainer style="padding:0 100px 0 100px;" ng-controller="formInputs">
			<h1>Create Vendor Page</h1>
			<div class=row style="border-top:1px solid black">
				<div class=col-2>
					<div class="logo-round" style="max-width:100%;width:200px;height:200px;border-radius:50%;">
						<form action="/php_scripts/updateVendorProfilePhoto.php" id='profile-logo' class="dropzone"></form>
					</div>
				</div>
				<div class=col-5>
					<label>Vendor Name</label>
					<p><input type=text name="name" ng-model="name" form="vendor-dropzone" class="vendorMemberInputLarge"><div class="formMessage">{{nameMsg}}</div></p>

					<label>Vendor Category</label>
					<p><input type=text name="category" ng-model="category" form="vendor-dropzone" class="vendorMemberInputLarge"><div class="formMessage">{{categoryMsg}}</div></p>

					<label>Additional tags</label>
					<p><input type=text name="tags" ng-model="tags" form="vendor-dropzone" class="vendorMemberInputLarge"><div class="formMessage">{{tagMsg}}</div></p>

					<label>Address</label>
					<p><input type=text name="address1" ng-model="address1" form="vendor-dropzone" class="vendorMemberInputLarge"><div class="formMessage">{{address1Msg}}</div></p>
					<p><input type=text name="address2" ng-model="address2" form="vendor-dropzone" class="vendorMemberInputLarge"></p>

					<label>City</label>
					<p><input type=text name="city" ng-model="city" form="vendor-dropzone" class="vendorMemberInputLarge"><div class="formMessage">{{cityMsg}}</div></p>
					<p><input type=text name="postcode" ng-model="postcode" form="vendor-dropzone" class="vendorMemberInputSmall"><label> POSTCODE</label><div class="formMessage">{{postcodeMsg}}</div>

					<p><label>Telephone</label><label>Telephone 2</label></p>
					<p><input type=number name="telephone1" ng-model="telephone1" form="vendor-dropzone" class="vendorMemberInputSmall"><input type=number name="telephone2" ng-model="telephone2" form="vendor-dropzone" class="vendorMemberInputSmall">
					<p><div class="formMessage">{{tel1Msg}}</div></p>

					<label>Website</label><label>Email</label>
					<p><input type=url name="website" ng-model="website" form="vendor-dropzone" class="vendorMemberInputSmall"><input type=text name="email" ng-model="email" form="vendor-dropzone" class="vendorMemberInputSmall"></p>
					<p><div class="formMessage">{{websiteMsg}}</div><div class="formMessage">{{emailMsg}}</div></p>
				</div>
				<div class=col-5>
					<label>Facebook</label>
					<p><input type=url name=facebook ng-model="facebook" form="vendor-dropzone" class="vendorMemberInputLarge"><div class="formMessage">{{facebookMsg}}</div></p>

					<label>Instagram</label>
					<p><input type=url name=instagram ng-model="instagram" form="vendor-dropzone" class="vendorMemberInputLarge"><div class="formMessage">{{instagramMsg}}</div></p>

					<label>Twitter</label>
					<p><input type=url name=twitter ng-model="twitter" form="vendor-dropzone" class="vendorMemberInputLarge"><div class="formMessage">{{twitterMsg}}</div></p>

					<label>I confirm that I am the owner of this business</label><input name=isOwner form=vendor-dropzone type=checkbox>

					<p><button id="submitVendorButton" ng-click="validate();">Submit Vendor</button></p>

				</div>
			</div>
			<div class="row">
				<div class=col-2></div>
				<div class="col-10" style="height:auto;" >
					<form action="/php_scripts/uploadVendorPhotos.php" id="vendor-dropzone" class="dropzone" style="width:100%;height:400px;text-align:center;float:left;"></form>
				</div>
			</div>
		</div>

		<script src="/javascript/validateInputs.js"></script>
		
		<script>
			var vendorId = -1;
			var isValid=true;
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
						
				  	  // 	var url = $("#vendor-dropzone").attr("action");
    					// var formData = $("#vendor-dropzone").serializeArray();
    					// console.log(formData);
    					
					});
					this.on("error",function(file){
						if(file.type != "image/*"){
							swal("Cannot add file","Error has occured", "error");
							dropzone.removeFile(file);
						}

					});
					this.on("sendingmultiple",function(file,xhr,formData){
						$("input[form=vendor-dropzone]").each(function(){ //Parses the form input data
							if($(this).attr("type") != "checkbox")
								formData.append($(this).attr("name"),$(this).val());
							else
								formData.append($(this).attr("name"),$(this).is(":checked"));
							
						});
						// formData = $("#vendor-dropzone").serializeArray();
					});

					this.on("success", function(file, xhr){
						data = JSON.parse(file.xhr.response);
						if(vendorId == -1){
                			if(data["id"] == -1)
                				swal("Cannot create page","Vendor already exists", "error");
                			else{
                				vendorId = data["id"];

                				$("#profile-logo").get(0).dropzone.processQueue();
                			}
						}
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
               			swal("Page created successfully","Check email to claim the page", "success");
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

			Dropzone.options.profileLogo = {
				autoProcessQueue: false,
				uploadMultiple: false,
				parallelUploads: 1,
				dictDefaultMessage: "Drop or click to change logo (7MB max)",
				paramName: "logo", // The name that will be used to transfer the file
				maxFilesize: 7, // MB
				maxFiles: 1,
				acceptedFiles: "image/*",
				addRemoveLinks: true,
				dictRemoveFile: "Remove",
				init: function() {

					var dropzone = this; 

					this.on("error",function(file){
						if(file.type != "image/*"){
							swal("Cannot add file","File is not an image", "error");
							dropzone.removeFile(file);
						}
					});
					this.on("addedfile",function(file){
						if(file.type != "image/png" && file.type != "image/jpeg" && file.type != "image/jpg"){
							swal("Cannot add file","File is not an image", "error");
							dropzone.removeFile(file);
						}
					});
					this.on("sending",function(file,xhr,formData){
						formData.append("id",vendorId); //Sends the id as form data
						// formData = $("#vendor-dropzone").serializeArray();
					});
					

					// this.on("queuecomplete",function(file){
					// 	swal("Complete","", "success");
					// });
					this.on("maxfilesexceeded",function(file){
						swal("Cannot add image","Cannot use multiple photos", "error");
						dropzone.removeFile(file);
					});
				}
			};

			$(document).ready(function(){
				$("#submitVendorButton").click(function(){
					

				});
				$("#profile-logo").change(function(){
					if (this.files && this.files[0]) {
			        	var reader = new FileReader();

				        reader.onload = function (e) {
				        	alert
				            $('.logo-round').attr('src', e.target.result);
			        	}	
			        	reader.readAsDataURL(this.files[0]);
			    	}
				})

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
		//Login script for the login modal
			app.controller('formInputs',function($scope){
				$scope.validate = function(){
					$scope.emailMsg = validateEmail($scope.email);
					$scope.categoryMsg = validateInput(($scope.category));
					$scope.nameMsg = validateInput($scope.name);
					$scope.address1Msg = validateInput($scope.address1);
					$scope.cityMsg = validateInput(($scope.city));
					$scope.websiteMsg = validateURL(($scope.website));
					$scope.postcodeMsg = validatePostcode(($scope.postcode));
					$scope.tel1Msg = validateNumber(($scope.telephone1));
					$scope.facebookMsg = validateURL(($scope.facebook));
					$scope.instagramMsg = validateURL(($scope.instagram));
					$scope.twitterMsg = validateURL(($scope.twitter));
					console.log($scope)

					if($scope.emailMsg+$scope.categoryMsg+$scope.nameMsg+$scope.address1Msg+$scope.cityMsg+$scope.websiteMsg+$scope.postcodeMsg+$scope.tel1Msg+$scope.facebookMsg+$scope.instagramMsg+$scope.twitterMsg != "")
						isValid=false;
					else
						isValid=true;

					// event.preventDefault();  
				 //  	event.stopPropagation();
					if(isValid){
						$(".formMessage").hide();
						$("#vendor-dropzone").get(0).dropzone.processQueue(); //Processes all images in the queue when submit button clicked
					}else{
						swal("Cannot create profile","Some fields not filled in correctly", "error");
						$(".formMessage").fadeIn();
					}
				}
	
			});
		</script>
	</body>
	
</html>