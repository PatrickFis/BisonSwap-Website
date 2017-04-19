<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Offers | Bison Swap</title>
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
<body>
<?php
    include 'navbar.php';
?>
<div id="panels">

</div>


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
  function Item(date, email, itemCategory, itemDescription, itemName, pic_1, rating, key, offers, url) {
    this.date = date;
    this.email = email;
    this.itemCategory = itemCategory;
    this.itemDescription = itemDescription;
    this.itemName = itemName;
    this.pic_1 = pic_1;
    this.rating = rating;
    this.key = key;
    this.offers = offers;
    this.url = url;
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
      childSnapshot.key,
      childSnapshot.val().offer,
      childSnapshot.val().url);
      var item = new Item(
        childSnapshot.val().date,
        childSnapshot.val().email,
        childSnapshot.val().itemCategory,
        childSnapshot.val().itemDescription,
        childSnapshot.val().itemName,
        childSnapshot.val().pic_1,
        childSnapshot.val().rating,
        childSnapshot.key,
        childSnapshot.val().offer,
        childSnapshot.val().url
      );
      items.push(item);
    });
    localStorage.setItem("Item", JSON.stringify(items));
    var panel = document.getElementById("panels");
    var string = "";
    for(var i = 0; i < items.length; i++) {
      if(items[i].offers != null) {
        var off_key = Object.keys(items[i].offers)
        for(var j = 0; j < off_key.length; j++) {
          // If the user has made an offer on an item
          if(items[i].offers[off_key[j]].email == firebase.auth().currentUser.email) {
            string += '<div class="col-md-6 portfolio-item">';
            string += '<a href="#">';
            // Replace src with image from database
            string += '<img height=400 width=100% src="'+items[i].url+'" id ="pic_'+i+'" alt="">';
            string += '</a>';
            string += '<div class="panel panel-default">';
            string += '<div class="panel-heading">';
            string += '<h4 class="panel-title">';
            string += items[i].itemName;
            string += '</h4>';
            string += '</div>';
            string += '<div class="panel-body">' + '<b>Offered item:&nbsp;</b>' + items[i].offers[off_key[j]].itemName;
            var chat_emails = [firebase.auth().currentUser.email, items[i].email];
            chat_emails = chat_emails.sort();
            string += '&nbsp;&nbsp;<a href="web/chat.php?email1='+chat_emails[0]+'&email2='+chat_emails[1]+'" class="btn btn-info float-right" role="button">Chat with user</a>'
            string += '&nbsp;&nbsp;<a href="#" class="btn btn-link float-right">Extend Offer</a>';
            string += '</div>'
            string += '<div class="panel-footer">Panel Footer</div>';
            string += '</div>';
            string += '</div>';
          }
          else {
            string += "No offers";
          }
        }
      }
    }
    string += '</div>';
    panel.innerHTML = string;
  });
</script>



<script src="web/scripts/auth.js"></script>

</body>
</html>
