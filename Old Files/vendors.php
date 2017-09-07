<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<Content-Type: text/html; charset=utf-8>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
	<link rel="stylesheet" href="css/vendors.css">
	<title>Vendors</title>
</head>
<body>
<?php include "navbar.php" ?>
<div class="container">
	<div class=row>
		<div class="col-md-10">
			<h1 id=category><?php echo strtoupper($_POST["category"]);?></h1>
		</div>
		<div class="col-md-2">
			<div class=dropdown><a class='dropdown-toggle pull-right' data-toggle='dropdown' href='#' id=filter1>PRICE <span class='caret'></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href='#' id=ratingFilter>RATINGS</a></li>
					<li><a href='#' id=priceFilter>PRICE</a></li>
					<li><a href='#' id=priceFilter>DISTANCE</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class=page-header></div>


	<div class=row>
		<?php include 'filters.php' ?>
		<div id="pages">
			<div class="col-sm-3 col-xs-12">
			    <div class="thumbnail">
			      <a href="#">
			        <img src="/img/Wedding.jpg" alt="Lights" style="width:100%">
			        <div class="caption">
			          <p>SSSS</p>
			        </div>
			      </a>
			    </div>
			  </div>
			  <div class="col-sm-3 col-xs-12">
			    <div class="thumbnail">
			      <a href="/w3images/nature.jpg">
			        <img src="/img/Wedding.jpg" alt="Nature" style="width:100%">
			        <div class="caption">
			          <p>Lorem ipsum...</p>
			        </div>
			      </a>
			    </div>
			  </div>
			  <div class="col-sm-3 col-xs-12">
			    <div class="thumbnail">
			      <a href="/w3images/fjords.jpg">
			        <img src="/img/Wedding.jpg" alt="Fjords" style="width:100%">
			        <div class="caption">
			          <p>Lorem ipsum...</p>
			        </div>
			      </a>
			    </div>
	  		</div>
	  		<div class="col-sm-3 col-xs-12">
			    <div class="thumbnail">
			      <a href="#">
			        <img src="/img/Wedding.jpg" alt="Lights" style="width:100%">
			        <div class="caption">
			          <p>SSSS</p>
			        </div>
			      </a>
			    </div>
			  </div>
			  <div class="col-sm-3 col-xs-12">
			    <div class="thumbnail">
			      <a href="/w3images/nature.jpg">
			        <img src="/img/Wedding.jpg" alt="Nature" style="width:100%">
			        <div class="caption">
			          <p>Lorem ipsum...</p>
			        </div>
			      </a>
			    </div>
			  </div>
			  <div class="col-sm-3 col-xs-12">
			    <div class="thumbnail">
			      <a href="/w3images/fjords.jpg">
			        <img src="/img/Wedding.jpg" alt="Fjords" style="width:100%">
			        <div class="caption">
			          <p>Lorem ipsum...</p>
			        </div>
			      </a>
			    </div>
	  		</div>

	  	</div>
	</div>
</div>


<script>
var pageData = [];
var index = 0;
function loadPages(){
	postData = {
		category : $("#category").text(),
		filter1 : $("#filter1").text(),
		order : $("#order").text()
	}
	$.post('getVendors.php',postData,function(data){
		pageData = JSON.parse(data);

		for(i=index;i<25;i++){
			if(index < data.length)
				createPageElement(pageData);
			else
				break;
		}
	});
}


function createPageElement(data){
	$("#pages").append("<div class='col-lg-3 col-md-12'><div class='thumbnail'><a href="++"><img src=./reviews/"+data["VendorPageID"]+"/images/profile.jpg alt='Fjords' style='width:100%'><div class='caption'><p>Lorem ipsum...</p></div></a></div>");
}
</script>

</body>
</html>