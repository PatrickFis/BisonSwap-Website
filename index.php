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
<header class="mdl-layout__header mdl-color-text--white mdl-color--light-blue-700">
  <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-grid">
    <div class="mdl-layout__header-row mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
      <h3><i class="material-icons">business</i>BisonSwap</h3>
    </div>
    <div class="container">
      <div class="navbar-left">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav">
          <li><a href="recent-uploads.php">Link 1<span class="sr-only">(current)</span></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Link 2<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="dancehall.php">Sub Link 1</a></li>
              <li><a href="gospel.php">Sub Link 2</a></li>
              <li><a href="hiphop.php">Sub Link 3</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="drama.php">Another Link</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="vlogs.php">One More</a></li>
            </ul>
          </li>
        </ul>

        <form action="search.php" class="navbar-left navbar-form mobile-hidden" role="search">
          <div class="input-group add-on">
            <input type="text" class="input form-control" placeholder="Search" name="search" autocomplete="off">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </div>
          <br>
          <div style="position:absolute; width:232px; z-index:1;background-color:#fff;" class="entry"></div>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="create-profile.php">Link 4</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Link 5<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="upload-youtube-video.php">Sub Link 1</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="create-profile.php">Sub Link 2</a></li>
            </ul>
          </li>
          <li><a href="contact.php">Link 6</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
            <ul class="dropdown-menu">
            	<li><a href="">My Account</a></li>
            	<li><a href="">Trade Histor</a></li>
            	<li><a href="">My Account</a></li>
            </ul>
          </li>
        </ul>
      </div>
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
</header>
<body>
<?php
    include 'navbar.php';
?>

<div class="container">
  <?php
    include 'sign-in-form.php';
  ?>
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
<script src="web/scripts/auth.js"></script>

</body>
</html>
