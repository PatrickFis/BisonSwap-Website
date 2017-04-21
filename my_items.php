<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Items | Bison Swap</title>
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

  <!-- Snackbar styling -->
  <link rel="stylesheet" href="css/snackbar.css">
</head>
<body>
<?php
    include 'navbar.php';
?>
<div class="container">
  <div class="row" id="panels">
  </div>
</div>

<div id="snackbar">Offer accepted</div>


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
  function Item(date, email, itemCategory, itemDescription, itemName, pic_1, rating, key, offers, url, arrived, shipped) {
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
    this.arrived = arrived;
    this.shipped = shipped;
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
      childSnapshot.val().url,
      childSnapshot.val().arrived,
      childSnapshot.val().shipped);
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
        childSnapshot.val().url,
        childSnapshot.val().arrived,
        childSnapshot.val().shipped
      );
      items.push(item);
    });
    localStorage.setItem("Item", JSON.stringify(items));
    var panel = document.getElementById("panels");
    var string = "";
    for(var i = 0; i < items.length; i++) {
      if(items[i].email == firebase.auth().currentUser.email) {
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
      if(items[i].offers != null) {
        // Get the key for the offers object and use it to grab the name and other information
        var off_key = Object.keys(items[i].offers);
        for(var j = 0; j < off_key.length; j++) {
          string += '<div class="panel-body"><a href="item.php?key='+items[i].offers[off_key[j]].item+'">'+items[i].offers[off_key[j]].itemName+'</a>';
          var chat_emails = [firebase.auth().currentUser.email, items[i].offers[off_key[j]].email];
          chat_emails = chat_emails.sort();
          string += '&nbsp;&nbsp;<a href="web/chat.php?email1='+chat_emails[0]+'&email2='+chat_emails[1]+'" class="btn btn-info" role="button">Chat with user</a>';
          if(items[i].offers[off_key[j]].accepted == "1") {
            string += "&nbsp;&nbsp;Offer accepted.";
            string += '<div>';
            string += '<p>Update your item\'s status:</p>';
            string += '<br><button onclick=updateYourItem("'+items[i].key+'") class="btn btn-info">Item Shipped</button>';
            string += '</div>';
            string += '<div>';
            string += '<p>Status of offered item:</p>';
            if(items[i].offers[off_key[j]].shipped == "0") {
              // Show this if the item has not been shipped
              string += '<br><p>Item has not been shipped</p>';
            }
            else {
              // If the item has arrived, show this instead of the item arrived button.
              if(items[i].offers[off_key[j]].arrived == "1") {
                string += '<br><p>Item has arrived. Click the button below to provide feedback.</p>';
                string += '<br><button onclick=provideFeedback("'+off_key[j]+'","'+items[i].key+'") class="btn btn-info">Provide Feedback</button>';
              }
              // Show this if the item has been shipped.
              else {
                string += '<br><p>Item has been shipped. Click the button below if the item has arrived.</p>';
                string += '<br><button onclick=offeredItemArrived("'+off_key[j]+'","'+items[i].key+'") class="btn btn-info">Item Arrived</button>';
              }
            }
            string += '</div>';
          }
          else {
            string += '&nbsp;&nbsp;<button onclick=acceptOffer("'+off_key[j]+'","'+items[i].key+'") class="btn btn-info">Accept</button>';
            string += '&nbsp;&nbsp;<button onclick=rejectOffer("'+off_key[j]+'","'+items[i].key+'") class="btn btn-info">Reject</button>';
          }
          string += '</div>'
          }
        }
        else {
          string += '<div class="panel-body">No Offers</div>';
        }

        string += '<div class="panel-footer">Panel Footer</div>';
        string += '</div>';
        string += '</div>';
      }
      // string += '<div hidden>'+items[i].key+'</div>';
      string += '</div>';
    }
    string += '</div>';
    panel.innerHTML = string;
  });
</script>
<script>
  function acceptOffer(offerKey, itemID) {
    firebase.database().ref('/items/'+itemID+'/offer/'+offerKey).once('value').then(function(snapshot) {
      var pushData = {
        date: snapshot.val().date,
        email: snapshot.val().email,
        item: snapshot.val().item,
        itemName: snapshot.val().itemName,
        uid: snapshot.val().uid,
        accepted: 1,
        shipped: snapshot.val().shipped,
        arrived: snapshot.val().arrived
      };
      var updates = {};
      // Remove all other offers
      firebase.database().ref('/items/'+itemID+'/offer/').remove();
      updates['/items/'+itemID+'/offer/'+offerKey] = pushData;
      return firebase.database().ref().update(updates);
    });
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");
    // Add the "show" class to DIV
    x.innerHTML = "Offer Accepted";
    x.className = "show";
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }
  function rejectOffer(offerKey, itemID) {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");
    // Add the "show" class to DIV
    x.innerHTML = "Offer Rejected";
    x.className = "show";
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    return firebase.database().ref('/items/'+itemID+'/offer/'+offerKey).remove();
  }
  function updateYourItem(itemID) {
    // Update the shipping status of your item
    firebase.database().ref('/items/'+itemID).once('value').then(function(snapshot) {
      var pushData = {
        arrived: snapshot.val().arrived,
        date: snapshot.val().date,
        email: snapshot.val().email,
        itemCategory: snapshot.val().itemCategory,
        itemDescription: snapshot.val().itemDescription,
        itemName: snapshot.val().itemName,
        offer: snapshot.val().offer,
        pic_1: snapshot.val().pic_1,
        rating: snapshot.val().rating,
        shipped: 1,
        url: snapshot.val().url
      };
      var updates = {};
      updates['/items/'+itemID] = pushData;
      return firebase.database().ref().update(updates);
    });
  }
  function offeredItemArrived(offerKey, itemID) {
    // Updates the arrived field in the offer reference
    firebase.database().ref('/items/'+itemID+'/offer/'+offerKey).once('value').then(function(snapshot) {
      var pushData = {
        accepted: snapshot.val().accepted,
        arrived: 1,
        date: snapshot.val().date,
        email: snapshot.val().email,
        item: snapshot.val().item,
        itemName: snapshot.val().itemName,
        uid: snapshot.val().uid,
        shipped: snapshot.val().shipped,
        accepted: snapshot.val().accepted
      };
      var updates = {};
      updates['/items/'+itemID+'/offer/'+offerKey] = pushData;
      return firebase.database().ref().update(updates);
    });
  }
</script>


<script src="web/scripts/auth.js"></script>

</body>
</html>
