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
    include '../navbar.php';
?>

<form>
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="email" type="text" class="form-control" name="email" placeholder="Enter a user's email">
  </div>
  <button type="submit" class="btn btn-success" onclick="chat()">Submit</button>
</form>

<p id="chatOptions"></p>

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
  function chat() {
    var currentEmail = firebase.auth().currentUser.email.replace(/[.]/g, "(");
    var targetEmail = document.getElementById("email").value.replace(/[.]/g, "(");
    var pushData = {
      name: firebase.auth().currentUser.displayName,
      text: 'Change me',
      photoUrl: firebase.auth().currentUser.photoURL || '/images/profile_placeholder.png'
      // text: ''
      // changeme: 1
    };
    var updates = {};
    // updates = pushData;
    updates['test/' + currentEmail + '_BISONSWAP_' + targetEmail + "/"] = pushData;
    return firebase.database().ref().update(updates);
  }
</script>
<script>
  // Create an array of emails for user to chat with
  var array = [];
  var ref = firebase.database().ref('test/').once('value').then(function(snapshot) {
    snapshot.forEach(function(childSnapshot) {
      // console.log(childSnapshot.key)
      var tempMail = childSnapshot.key.replace(/[(]/g, ".");
      var tempArray = tempMail.split("_BISONSWAP_");
      if(tempMail.includes(firebase.auth().currentUser.email)) {
        array.push(tempArray[1]);
      }
      // array.push(tempArray[1]);
      console.log(array);
    });
    // var innerHTMLArray = [];
    if(array.length > 0) {

      // var string = '<a href="javascript:postwith(\'chat.php\',{email1:\''+firebase.auth().currentUser.email+'\',email2:\''+array[1]+'\'})">'+array[1]+'</a><br>';
      var string = '<a href="chat.php?email1=' + firebase.auth().currentUser.email + '&email2=' + array[1] + '">' + array[1] + '</a><br>';
      console.log(string);
      // var string = array[0] + '<button type="submit" class="btn btn-success" onclick="chat()">Submit</button><br>';
      for(var i = 2; i < array.length; i++) {
        // string += '<a href="javascript:postwith(\'chat.php\',{email1:\''+firebase.auth().currentUser.email+'\',email2:\''+array[i]+'\'})">'+array[i]+'</a><br>';
        string += '<a href="chat.php?email1=' + firebase.auth().currentUser.email + '&email2=' + array[i] + '">' + array[i] + '</a><br>';
        console.log(string);
        // innerHTMLArray[i] = string;
      }
  }
    document.getElementById("chatOptions").innerHTML = string;
  });
</script>
<script>
  // Create a form and then submit it.
  // Post with <a href="javascript:postwith('post.aspx',{user:'peter',cc:'aus'})">click</a>
  function postwith (url, array) {
    var myForm = document.createElement("form");
    myForm.method="post";
    myForm.action = url;
    for (var k in array) {
      var myInput = document.createElement("input");
      myInput.setAttribute("name", array);
      myInput.setAttribute("value", array[k]);
      myForm.appendChild(myInput);
    }
    document.body.appendChild(myForm);
    myForm.submit();
    document.body.removeChild(myForm);
  }
</script>
<script src="scripts/auth.js"></script>

</html>
