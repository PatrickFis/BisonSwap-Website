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

  <!-- Snackbar styling -->
  <link rel="stylesheet" href="css/snackbar.css">
</head>
<body>
<?php
    include 'navbar.php';
?>
<div id="panels">

</div>
<div id="snackbar">Offer extended</div>

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
  function Item(date, email, itemCategory, itemDescription, itemName, pic_1, rating, key, offers, url, arrived, shipped, rated) {
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
    this.rated = rated;
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
      childSnapshot.val().shipped,
      childSnapshot.val().rated
    );
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
        childSnapshot.val().shipped,
        childSnapshot.val().rated
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
            string += '<a href="item.php?key='+items[i].key+'">';
            // Replace src with image from database
            string += '<img height=400 width=100% src="uploads/'+items[i].pic_1+'" id ="pic_'+i+'" alt="">';
            string += '</a>';
            string += '<div class="panel panel-default">';
            string += '<div class="panel-heading">';
            string += '<h4 class="panel-title">';
            string += items[i].itemName;
            string += '</h4>';
            string += '</div>';
            string += '<div class="panel-body">';
            if(items[i].offers[off_key[j]].accepted == 0) {
              // If the item has not yet been accepted display a table with
              // the offered item's name, a chat button, and an extend offer
              // button.
              string += '<table class="table">';
              string += '<thead>';
              string += '<tr>';
              string += '<th>Offered Item</th>';
              string += '<th>Chat</th>';
              string += '<th>Extend</th>';
              string += '</tr>';
              string += '</thead>';
              string += '<tbody>';
              string += '<tr>';
              string += '<th>'+items[i].offers[off_key[j]].itemName+'</th>';
              var chat_emails = [firebase.auth().currentUser.email, items[i].email];
              chat_emails = chat_emails.sort();
              string += '<th><a href="web/chat.php?email1='+chat_emails[0]+'&email2='+chat_emails[1]+'" class="btn btn-info" role="button">Chat with user</a></th>';
              string += '<th><button onclick=extendOffer("'+off_key[j]+'","'+items[i].key+'") class="btn btn-info">Extend Offer</button></th>';
              string += '</tr>';
              string += '</tbody>';
              string += '</table>';
            }
            else if(items[i].offers[off_key[j]].accepted == 1) {
              // If the item has been accepted by the other user, display
              // a table with the offered items name, a chat button, the
              // status of the other item, a button to ship your item,
              // and a button to receive the other item.
              string += '<table class="table">';
              string += '<thead>';
              string += '<tr>';
              string += '<th>Offered Item</th>';
              string += '<th>Chat</th>';
              string += '<th>Ship Your Item</th>';
              string += '<th>Status of Other Item</th>';
              string += '<th>Receive Item</th>';
              string += '</tr>';
              string += '</thead>';
              string += '<tbody>';
              string += '<tr>';
              string += '<th>'+items[i].offers[off_key[j]].itemName+'</th>';
              var chat_emails = [firebase.auth().currentUser.email, items[i].email];
              chat_emails = chat_emails.sort();
              string += '<th><a href="web/chat.php?email1='+chat_emails[0]+'&email2='+chat_emails[1]+'" class="btn btn-info" role="button">Chat with user</a></th>';
              if(items[i].offers[off_key[j]].shipped == 0) {
                // You have not shipped your item yet
                string += '<th><button onclick=updateYourItem("'+off_key[j]+'","'+items[i].key+'") class="btn btn-info">Item Shipped</button></th>';
              }
              else if(items[i].offers[off_key[j]].shipped == 1) {
                // You have shipped your item
                string += '<th>Item shipped</th>';
              }
              if(items[i].shipped == 0) {
                // Other item has not been shipped yet;
                string += '<th>Not shipped</th>';
                string += '<th>Not shipped</th>';
              }
              else if(items[i].shipped == 1) {
                if(items[i].arrived == 0) {
                  string += '<th>Item shipped</th>';
                  string += '<th><button onclick=otherItemArrived("'+items[i].key+'") class="btn btn-info">Item Arrived</button></th>';
                }
                else if(items[i].arrived == 1) {
                  string += '<th>Item arrived</th>';
                  string += '<th><a href="itemFeedback.php?itemKey='+items[i].key+'" class="btn btn-info">Provide Feedback</a></th>';
                }
              }
              string += '</tr>';
              string += '</tbody>';
              string += '</table>';
            }
            string += '</div>';
            string += '</div>';
            string += '</div>';
          }
        }
      }
    }
    string += '</div>';
    panel.innerHTML = string;
  });
</script>

<script>
  function extendOffer(offerKey, itemID) {
    // Extend the offer by overwriting the current date with the current date
    firebase.database().ref('/items/'+itemID+'/offer/'+offerKey).once('value').then(function(snapshot) {
      var pushData = {
        date: new Date().getTime(),
        email: snapshot.val().email,
        item: snapshot.val().item,
        itemName: snapshot.val().itemName,
        uid: snapshot.val().uid,
        accepted: snapshot.val().accepted,
        shipped: snapshot.val().shipped,
        arrived: snapshot.val().arrived,
        rated: snapshot.val().rated
      };
      var updates = {};
      updates['/items/'+itemID+'/offer/'+offerKey] = pushData;
      return firebase.database().ref().update(updates);
    });
   // Get the snackbar DIV
   var x = document.getElementById("snackbar")
   // Add the "show" class to DIV
   x.className = "show";
   // After 3 seconds, remove the show class from DIV
   setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }
  function updateYourItem(offerKey, itemID) {
    // Update the shipping status of your item
    firebase.database().ref('/items/'+itemID+'/offer/'+offerKey).once('value').then(function(snapshot) {
      var pushData = {
        accepted: snapshot.val().accepted,
        arrived: snapshot.val().arrived,
        date: snapshot.val().date,
        email: snapshot.val().email,
        item: snapshot.val().item,
        itemName: snapshot.val().itemName,
        uid: snapshot.val().uid,
        shipped: 1,
        accepted: snapshot.val().accepted,
        rated: snapshot.val().rated,
        pic_1: snapshot.val().pic_1
      };
      // Get the snackbar DIV
      var x = document.getElementById("snackbar");
      // Add the "show" class to DIV
      x.innerHTML = "Item Shipped";
      x.className = "show";
      // After 3 seconds, remove the show class from DIV
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      var updates = {};
      updates['/items/'+itemID+'/offer/'+offerKey] = pushData;
      return firebase.database().ref().update(updates);
    });
  }
  function otherItemArrived(itemID) {
    // Update the arrival status of the item you traded for
    firebase.database().ref('/items/'+itemID).once('value').then(function(snapshot) {
      var pushData = {
        arrived: 1,
        date: snapshot.val().date,
        email: snapshot.val().email,
        itemCategory: snapshot.val().itemCategory,
        itemDescription: snapshot.val().itemDescription,
        itemName: snapshot.val().itemName,
        offer: snapshot.val().offer,
        pic_1: snapshot.val().pic_1,
        rating: snapshot.val().rating,
        shipped: snapshot.val().shipped,
        //url: snapshot.val().url,
        rated: snapshot.val().rated,
        uid: snapshot.val().uid
      };
      // Get the snackbar DIV
      var x = document.getElementById("snackbar");
      // Add the "show" class to DIV
      x.innerHTML = "Item Arrived";
      x.className = "show";
      // After 3 seconds, remove the show class from DIV
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      var updates = {};
      updates['/items/'+itemID] = pushData;
      return firebase.database().ref().update(updates);
    });
  }
</script>


<script src="web/scripts/auth.js"></script>

</body>
</html>
