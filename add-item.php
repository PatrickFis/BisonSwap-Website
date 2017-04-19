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
</head>
<body>
  <?php include 'navbar.php'; ?>

  <div class="container">
    <div class="rows">
      <div class="col-sm-8">
        <div class="form">
          <form>
            <div class="form-group">
              <h2 class="">Upload your item information</h2>
            </div>
            <div class="form-group">
              <hr />
            </div>
            <div class="form-group">
              <label for="itemname">Item Name:</label>
              <input type="itemname" class="form-control" id="itemname">
            </div>
            <div class="form-group">
              <label for="cat">Category:</label>
              <select class="form-control" id="cat">
                <option value disabled selected style="display: none;">Select Category</option>
                <option>Cat 1</option>
                <option>Cat 2</option>
                <option>Cat 3</option>
                <option>Cat 4</option>
              </select>
            </div>
            <div class="form-group">
              <label for="condition">Item Condition:</label>
              <select class="form-control" id="condition">
                <option value disabled selected style="display: none;">-Select-</option>
                <option>1 - Like new</option>
                <option>2 - Very Good</option>
                <option>3 - Good</option>
                <option>4 - Fair</option>
                <option>5 - Acceptable</option>
                <option>6 - Has defects</option>
                <option>7 - Slightly damaged</option>
                <option>8 - Need repair</option>
              </select>
            </div>
            <div class="form-group">
              <label for="item-description">Item Description:</label>
              <textarea class="form-control" rows="5" id="item-description"></textarea>
            </div>
            <div class="form-group">
              <p><b>Upload an image</b></p>
            </div>
            <div class="form-group">
              <input class="btn btn-default btn-file" type="file" name="pic-1" id="pic-1">
            </div>
    <div class="form-group">
      <hr />
    </div>
    <button type="submit" class="btn btn-success" onclick="addItem()">Submit</button>
  </form>
</div>
</div>
</div>
</body>
<script>
function addItem() {
  var file1 = document.getElementById("pic-1").files[0];
  var user = firebase.auth().currentUser;
  var storageRef = firebase.storage().ref();
  var pic_1_name = document.getElementById("pic-1").value;
  storageRef = firebase.storage().ref("images/" + file1.name);
    uploadTask = storageRef.put(file1);

    uploadTask.on('state_changed', function(snapshot) {

    }, function(error) { 

    }, function() {
      var downloadURL = uploadTask.snapshot.downloadURL;
      console.log(downloadURL);

    }); 
  }
</script>
</html>
