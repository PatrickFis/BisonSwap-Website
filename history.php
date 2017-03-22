<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home | Bison Swap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/helper.css">
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
<script>
  // Get a list of all the items stored in the database
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
      var item = new Item(childSnapshot.val().date,
        childSnapshot.val().email,
        childSnapshot.val().itemCategory,
        childSnapshot.val().itemDescription,
        childSnapshot.val().itemName,
        childSnapshot.val().rating
      );
      items.push(item);
    });
    localStorage.setItem("Item", JSON.stringify(items));
    console.log(items);
    for(var i = 0; i < items.length; i++) {
      console.log(items[i].email);
    }
  });
</script>
<script src="web/scripts/auth.js"></script>

</html>
