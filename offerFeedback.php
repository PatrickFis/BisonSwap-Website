<!DOCTYPE html>
<html lang="en">
<script src="http://www.w3schools.com/lib/w3data.js"></script><div w3-include-html="content.html"></div>
<head>
  <title>Feedback | Bison Swap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/helper.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <!-- This page is for feedback on offered items -->
  <?php include 'navbar.php'; ?>
  <?php
  echo '<input type=hidden id="itemKey" name="itemKey" value="';
  echo $_GET["itemKey"];
  echo "\">";
  echo '<input type=hidden id="offerKey" name="offerKey" value="';
  echo $_GET["offerKey"];
  echo "\">";
  ?>
  <div class="container">
    <div class="rows">
      <div class="col-sm-8">
        <div class="form">
          <form>
            <div class="form-group">
              <h2 class="">Provide feedback</h2>
              <p>Use this form to provide feedback about the quality of the
                item you received. Not providing feedback will result in negative
                feedback being applied to the other person after a period of 72 hours.</p>
              </div>
              <div class="form-group">
                <hr />
              </div>
              <div class="form-group">
                <label for="condition">Was the item condition advertised correctly? (Rate on a scale of 1-10, with 1 being completely wrong, and 10 being advertised correctly)</label>
                <select class="form-control" id="condition">
                  <option value disabled selected style="display: none;">-Select-</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
              </div>
              <div class="form-group">
                <hr />
              </div>
              <?php
              echo '<button type="submit" class="btn btn-success" onclick=feedback(';
              echo "\"".$_GET["itemKey"]."\"";
              echo ',';
              echo "\"".$_GET["offerKey"]."\"";
              echo ')>Submit</button>';
              ?>
              <!-- <button type="submit" class="btn btn-success" onclick="feedback()">Submit</button> -->
            </form>
          </div>
        </div>
      </div>
    </body>
  <script>
    function feedback(itemKey, offerKey) {
      // Give the user a rating
      firebase.database().ref('/items/'+itemKey+'/offer/'+offerKey).once('value').then(function(snapshot) {
        var itemKey = document.getElementById("itemKey").value;
        var offerKey = document.getElementById("offerKey").value;
        var condition = document.getElementById("condition").value;
        var uid = snapshot.val().uid;
        // console.log(uid);
        // Update the rated field in items/itemKey/offer/offerKey
        var updateOfferRated = {
          accepted: snapshot.val().accepted,
          arrived: snapshot.val().arrived,
          date: snapshot.val().date,
          email: snapshot.val().email,
          item: snapshot.val().item,
          itemName: snapshot.val().itemName,
          uid: snapshot.val().uid,
          shipped: snapshot.val().shipped,
          accepted: snapshot.val().accepted,
          rated: 1,
          pic_1: snapshot.val().pic_1
        };
        var updateOffer = {};
        updateOffer['/items/'+itemKey+'/offer/'+offerKey] = updateOfferRated;
        firebase.database().ref().update(updateOffer);l
        var pushData = {
          rating: parseInt(condition)
        };
        var updates = {};
        var newPushKey = firebase.database().ref().child('users').push().key;
        console.log(uid);
        console.log(newPushKey);
        updates['users/'+uid+'/'+newPushKey] = pushData;
        return firebase.database().ref().update(updates);
      });
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
