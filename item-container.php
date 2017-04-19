<div class="container">
  	<div class="row">
	  	<div class="col-sm-9">
	  		<div class="carousel slide article-slide" id="article-photo-carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner cont-slider">
					<div class="item active">
					  <img id="pic_1" alt="" title="" src="http://placehold.it/600x400">
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
				<ol class="carousel-indicators" align = "center">
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
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Make Offer</button>

        <?php
          // echo '<a href="make_offer.php?KEY='.$_GET['key'].'">Make an offer</a>';
         ?>
	  	</div>
      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Make an Offer</h4>
            </div>
            <div class="modal-body" id="item_list">
              <p>Choose the item you wish to trade with...</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Trade this item</button>
            </div>
          </div>

        </div> 
      </div> 
  	</div>
</div>

<!-- <script>
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
    // console.log(items);
    var user = firebase.auth().currentUser;
    var offerItems = [];

    console.log("OFFER ITEMS");
    console.log(offerItems);
  });
</script> -->
<!-- <script>
    firebase.database().ref('/items/-Kg0hqYb_kdv-xGxraQo').once('value').then(function(snapshot) {
    	document.getElementById("item-name").innerHTML = snapshot.val().itemName;
    	document.getElementById("item-description").innerHTML = snapshot.val().itemDescription;
    });
</script> -->
