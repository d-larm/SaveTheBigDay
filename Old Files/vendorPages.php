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
<?php include "getSingleVendorPage.php" ?>
<div class="container">
	<div class=row>
		<div class="col-md-8">
			<h1 id=pageName><?php echo strtoupper($data["Name"]);?></h1>
		</div>
		<div class="col-md-2">
			<div class=rating>
			</div>
			<h4 id=isClaimed><?php
				if($data["IsClaimed"]) 
					echo "This page has been claimed <span class='glyphicon glyphicon-ok'></span>";
				else
					echo "<a href=/claimPage.php?id={$data['PageID']}>Is this your business?</a>";
			?>	
			</h4>
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
		<div class="col-lg-3 col-xs-12">
			<img src="/img/Wedding.jpg" class="img-circle img-responsive" alt="Cinque Terre" style='margin-bottom:10px;'>
			<div class=page-header></div>
		</div>


		<div id="pages">
			<div class="col-lg-3 col-xs-12">
			    <div class="thumbnail">
			      <a href="#">
			        <img src="/w3images/lights.jpg" alt="Lights" style="width:100%">
			        <div class="caption">
			          <p>SSSS</p>
			        </div>
			      </a>
			    </div>
			  </div>
			  <div class="col-lg-3 col-xs-12">
			    <div class="thumbnail">
			      <a href="/w3images/nature.jpg">
			        <img src="/w3images/nature.jpg" alt="Nature" style="width:100%">
			        <div class="caption">
			          <p>Lorem ipsum...</p>
			        </div>
			      </a>
			    </div>
			  </div>
			  <div class="col-lg-3 col-xs-12">
			    <div class="thumbnail">
			      <a href="/w3images/fjords.jpg">
			        <img src="/w3images/fjords.jpg" alt="Fjords" style="width:100%">
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
var data = "<?php echo $data ?>";

</script>

</body>
</html>