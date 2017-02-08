<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $iName; ?> | Bison Swap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/helper.css">
  <link rel="stylesheet" type="text/css" href="css/view-item.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php
    include 'navbar.php';
?>

<div class="container">
  	<div class="row">
	  	<div class="col-sm-7">
	  		<div class="carousel slide article-slide" id="article-photo-carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner cont-slider">
					<div class="item active">
					  <img alt="" title="" src="http://placehold.it/600x400">
					</div>
					<div class="item">
					  <img alt="" title="" src="http://placehold.it/600x400">
					</div>
					<div class="item">
					  <img alt="" title="" src="http://placehold.it/600x400">
					</div>
					<div class="item">
					  <img alt="" title="" src="http://placehold.it/600x400">
					</div>
					<div class="item">
					  <img alt="" title="" src="http://placehold.it/600x400">
					</div>
				</div>
				<ol class="carousel-indicators">
					<li class="active" data-slide-to="0" data-target="#article-photo-carousel">
					  <img alt="" src="http://placehold.it/250x180">
					</li>
					<li class="" data-slide-to="1" data-target="#article-photo-carousel">
					  <img alt="" src="http://placehold.it/250x180">
					</li>
					<li class="" data-slide-to="2" data-target="#article-photo-carousel">
					  <img alt="" src="http://placehold.it/250x180">
					</li>
					<li class="" data-slide-to="3" data-target="#article-photo-carousel">
					  <img alt="" src="http://placehold.it/250x180">
					</li>
					<li class="" data-slide-to="4" data-target="#article-photo-carousel">
					  <img alt="" src="http://placehold.it/250x180">
					</li>
				</ol>
	  	</div>
  	</div>
    <h2><b>Item Description:</b></h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <h2><b>Item Category:</b></h2>
    <p>Category 1</p>
    <h2><b>Condition:</b></h2>
    <p>1 - Like New</p>
</div>


</body>
</html>
