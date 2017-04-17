<div class="container">
  	<div class="row">
	  	<div class="col-sm-9">
	  		<div class="carousel slide article-slide" id="article-photo-carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner cont-slider">
					<div class="item active">
					  <img id="pic_1" alt="" title="" src="http://placehold.it/600x400">
					</div>
				</div>
			</div>
	  	</div>
	  	<div class="col-sm-3">
	  		<h3 id="item-name"></h3>
	  		<p><b>Description:<b><p>
	  		<p id="item-description"></p>
	  	</div>
  	</div>
</div>

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
    firebase.database().ref('/items/-Kg0hqYb_kdv-xGxraQo').once('value').then(function(snapshot) {
    	document.getElementById("item-name").innerHTML = snapshot.val().itemName;
    	document.getElementById("item-description").innerHTML = snapshot.val().itemDescription;
    });
</script>
