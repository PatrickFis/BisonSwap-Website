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
	  	<div class="col-sm-9">
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
	  	<div class="col-sm-3">
	  		<h3 id="item-name"></h3>
	  		<p><b>Description:<b><p>
	  		<p id="item-description"></p>
	  	</div>
  	</div>

</div>

</body>
<script src="https://www.gstatic.com/firebasejs/3.6.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.6.2/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.6.2/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.6.2/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.6.8/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyA0saZpdhgWuQ5MvD81I3K09M0Wbk31c6Q",
    authDomain: "bisonswap-a0af2.firebaseapp.com",
    databaseURL: "https://bisonswap-a0af2.firebaseio.com",
    storageBucket: "bisonswap-a0af2.appspot.com",
    messagingSenderId: "307753783953"
  };
  firebase.initializeApp(config);
</script>
<script src="web/scripts/auth.js"></script>

<script>
  function Item(date, email, itemCategory, itemDescription, itemName, rating) {
    this.date = date;
    this.email = email;
    this.itemCategory = itemCategory;
    this.itemDescription = itemDescription;
    this.itemName = itemName;
    this.rating = rating;
  }
  firebase.database().ref('/items/').once('value').then(function(snapshot) {
    var items = [];
    snapshot.forEach(function(childSnapshot) {
      console.log(childSnapshot.val().date,
      childSnapshot.val().email,
      childSnapshot.val().itemCategory,
      childSnapshot.val().itemDescription,
      childSnapshot.val().itemName,
      childSnapshot.val().rating);
      var item = new Item({
        "date": childSnapshot.val().date,
        "email": childSnapshot.val().email,
        "itemCategory": childSnapshot.val().itemCategory,
        "itemDescription": childSnapshot.val().itemDescription,
        "itemName": childSnapshot.val().itemName,
        "rating": childSnapshot.val().rating
      });
      items.push(item);
    });
    localStorage.setItem("Item", JSON.stringify(items));
    console.log(items);
  });
</script>
<script>
    firebase.database().ref('/items/-KdSNc76RleFK1GGPyLB').once('value').then(function(snapshot) {
    	document.getElementById("item-name").innerHTML = snapshot.val().itemName;
    	document.getElementById("item-description").innerHTML = snapshot.val().itemDescription;
    });
</script>

</html>
