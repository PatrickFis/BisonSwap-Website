<!DOCTYPE html>
<html lang="en">
<script src="http://www.w3schools.com/lib/w3data.js"></script><div w3-include-html="content.html"></div>
<head>
  <title>Home | Bison Swap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/helper.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include 'navbar.php'; ?>
  <?php
    // Key that holds the item on which an offer is being made
    echo '<input type=hidden id="KEY" name="KEY" value="';
    echo $_GET["KEY"];
    echo "\">";
    // echo '<input type=hidden id="email1" name="email1" value="' + $_GET["email1"] + '">';
    // echo '<input type=hidden id="email2" name="email2" value="' + $_GET["email2"] + '">';
   ?>
  <div class="container">
    <div class="rows">
      <div class="col-sm-8">
        <div class="form">
          <form>
            <div class="form-group">
              <h2 class="">Make an Offer</h2>
            </div>
            <div class="form-group">
              <hr />
            </div>
            <div class="form-group">
              <label for="itemname">Item Name:</label>
              <input type="itemname" class="form-control" id="itemname">
            </div>
            <div class="form-group">
              <label for="item-description">Offer Description:</label>
              <textarea class="form-control" rows="5" id="item-description"></textarea>
            </div>
            <!-- <div class="form-group">
            <input class="btn btn-default btn-file" type="file" name="pic-2" id="pic-2">
          </div>
          <div class="form-group">
          <input class="btn btn-default btn-file" type="file" name="pic-3" id="pic-3">
        </div>
        <div class="form-group">
        <input class="btn btn-default btn-file" type="file" name="pic-4" id="pic-4">
      </div>
      <div class="form-group">
      <input class="btn btn-default btn-file" type="file" name="pic-5" id="pic-5">
    </div> -->
    <div class="form-group">
      <hr />
    </div>
    <button type="submit" class="btn btn-success" onclick="offer()">Submit</button>
  </form>
</div>
</div>
</div>
</body>
<script>
function offer() {
  var user = firebase.auth().currentUser;
  // Key of item that you want...
  var offerKey = document.getElementById("KEY").value;
  console.log(offerKey);
  var pushData = {
    email: user.email,
    itemName: document.getElementById("itemname").value,
    offerDescription: document.getElementById("item-description").value
  }
  var updates = {};
  var newPushKey = firebase.database().ref().child('/items/').push().key;
  updates['/items/'+offerKey+'/offer/'+newPushKey] = pushData;
  return firebase.database().ref().update(updates);
}
</script>
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
</html>
