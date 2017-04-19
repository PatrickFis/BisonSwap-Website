<!DOCTYPE html>
<html lang="en">
<head>
  <title>Item Name Here | Bison Swap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/helper.css">
  <link rel="stylesheet" href="/css/view-item.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Disable tap highlight on IE -->
  <meta name="msapplication-tap-highlight" content="no">

  <!-- Web Application Manifest -->
  <link rel="manifest" href="manifest.json">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="application-name" content="Friendly Chat">
  <meta name="theme-color" content="#303F9F">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="apple-mobile-web-app-title" content="Friendly Chat">
  <meta name="apple-mobile-web-app-status-bar-style" content="#303F9F">

  <!-- Tile icon for Win8 -->
  <meta name="msapplication-TileColor" content="#3372DF">
  <meta name="msapplication-navbutton-color" content="#303F9F">

  <!-- Material Design Lite -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css">
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

  <!-- App Styling -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
  <link rel="stylesheet" href="web/styles/main.css">
</head>
<!-- User sign in and sign out -->
<!--header class="mdl-layout__header mdl-color-text--white mdl-color--light-blue-700">
  <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-grid">
    <div class="mdl-layout__header-row mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
      <h3><i class="material-icons">business</i>BisonSwap</h3>
    </div>
    <div id="user-container">
      <div hidden id="user-pic"></div>
      <div hidden id="user-name"></div>
      <button hidden id="sign-out" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--white">
        Sign-out
      </button>
      <button hidden id="sign-in" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--white">
        <i class="material-icons">account_circle</i>Sign-in
      </button>
    </div>
  </div>
</header-->
<body>
<?php
    include 'navbar.php';
?>
<?php
  echo '<input type=hidden id="KEY" name="KEY" value="';
  echo $_GET["key"];
  echo "\">";
  // echo '<input type=hidden id="email1" name="email1" value="' + $_GET["email1"] + '">';
  // echo '<input type=hidden id="email2" name="email2" value="' + $_GET["email2"] + '">';
 ?>
<?php include 'item-container.php'; ?>

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

<script>
  function Item(date, email, itemCategory, itemDescription, itemName, pic_1, rating, key) {
    this.date = date;
    this.email = email;
    this.itemCategory = itemCategory;
    this.itemDescription = itemDescription;
    this.itemName = itemName;
    this.pic_1 = pic_1;
    this.rating = rating;
    this.key = key;
  }
  firebase.database().ref('/items/').once('value').then(function(snapshot) {
    var items = [];
    snapshot.forEach(function(childSnapshot) {
      console.log(childSnapshot.val().date,
      childSnapshot.val().email,
      childSnapshot.val().itemCategory,
      childSnapshot.val().itemDescription,
      childSnapshot.val().itemName,
      childSnapshot.val().pic_1,
      childSnapshot.val().rating,
      childSnapshot.key);
      var item = new Item(
        childSnapshot.val().date,
        childSnapshot.val().email,
        childSnapshot.val().itemCategory,
        childSnapshot.val().itemDescription,
        childSnapshot.val().itemName,
        childSnapshot.val().pic_1,
        childSnapshot.val().rating,
        childSnapshot.key
      );
      items.push(item);
    });
    localStorage.setItem("Item", JSON.stringify(items));
    // console.log(items);

    // Get items for offer modal
    var offerItems = [];
    for(var i = 0; i < items.length; i++) {
      if(items[i].email == firebase.auth().currentUser.email) {
        offerItems.push(items[i]);
      }
    }
    // console.log("offer items");
    // console.log(offerItems);
    var string = '<div class="list-group">';
    for(var i = 0; i < offerItems.length; i++) {
      string += '<a href="#" class="list-group-item" id="' + offerItems[i].key + '">' + offerItems[i].itemName + '</a>';
    }
    string += '</div>';
    document.getElementById("item_list").innerHTML = string;
  });
</script>
<!-- On click for list items -->
<script>
  $(document).ready(function(){
    $(document).on('click', '.list-group-item', function(e){
        // alert(this.id);
        makeOffer(this.id);
    });
  });
</script>
<script>
  // Add an offer to the database
  function makeOffer(id) {
    var user = firebase.auth().currentUser;
    // Item that you are offering
    var offerKey = id;
    // Item that you are making an offer for
    var itemKey = document.getElementById("KEY").value;
    console.log(id);
    var pushData = {
      email: user.email,
      uid: user.uid,
      item: offerKey,
      itemName: document.getElementById(id).innerHTML,
      date: new Date(),
      accepted: 0
    }
    var updates = {};
    var newPushKey = firebase.database().ref().child('/items/').push().key;
    updates['/items/'+itemKey+'/offer/'+newPushKey] = pushData;
    return firebase.database().ref().update(updates);
  }
</script>
<script>
    var itemRef = '/items/' + document.getElementById("KEY").value;
    firebase.database().ref(itemRef).once('value').then(function(snapshot) {
      document.getElementById("item-name").innerHTML = snapshot.val().itemName;
      document.getElementById("item-description").innerHTML = snapshot.val().itemDescription;
      // This portion will download an image based on whatever is in the item reference's pic_1 field
      var storage = firebase.storage();
      var path = storage.ref(snapshot.val().pic_1);
      // document.getElementById("pic_1").innerHTML = path;
      // console.log("PATH URL");
      // console.log(path.getDownloadURL());
      path.getDownloadURL().then(function(url) {
        // `url` is the download URL for 'images/stars.jpg'

        // This can be downloaded directly:
        var xhr = new XMLHttpRequest();
        xhr.responseType = 'blob';
        xhr.onload = function(event) {
          var blob = xhr.response;
        };
        xhr.open('GET', url);
        xhr.send();

        // Or inserted into an <img> element:
        var img = document.getElementById('pic_1');
        img.src = url;
      }).catch(function(error) {
        // Handle any errors
      });
    });
</script>
<script src="web/scripts/auth.js"></script>

</body>
</html>
