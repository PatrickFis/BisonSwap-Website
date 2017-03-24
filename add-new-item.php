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
    <button type="submit" class="btn btn-success" onclick="addItem()">Submit</button>
  </form>
</div>
</div>
</div>
</body>
<script>
function addItem() {
  // document.getElementById("pic-1").addEventListener("submit", function(event) {
  //   event.preventDefault();
  // })
  // var timestamp = Number(new Date());
  // var storageRef = firebase.storage().ref(timestamp.toString());
  // var $ = jQuery;
  // var file_data = $('pic-1').prop('files')[0];
  // storageRef.put(file_data);
  // console.log("READ ME " + document.getElementById("pic-1").files.length);
  var user = firebase.auth().currentUser;
  var storageRef = firebase.storage().ref();
  var pic_1_name = document.getElementById("pic-1").value;
  // var pic_2_name = document.getElementById("pic-2").value;
  // var pic_3_name = document.getElementById("pic-3").value;
  // var pic_4_name = document.getElementById("pic-4").value;
  // var pic_5_name = document.getElementById("pic-5").value;
  if(pic_1_name.length < 4) {
    pic_1_name = '0';
  }
  else pic_1_name = 'images/' + user.uid + '/' + document.getElementById("itemname").value + '/' + pic_1_name.substring(pic_1_name.lastIndexOf('\\')+1, pic_1_name.length);
  var pushData = {
    email: user.email,
    itemName: document.getElementById("itemname").value,
    itemCategory: document.getElementById("cat").value,
    itemDescription: document.getElementById("item-description").value,
    date: new Date(),
    //itemPictures: document.getElementById("pic-1").value,
    pic_1: pic_1_name,
    rating: document.getElementById("condition").value
  };
  var newPushKey = firebase.database().ref().child('items').push().key;
  var updates = {};
  updates['/items/' + newPushKey] = pushData;
  // Get the first image uploaded by the user
  if(pic_1_name != '0') {
    var file1 = document.getElementById("pic-1").files[0];
    storageRef.child(pic_1_name).put(file1).then(function(snapshot) {
      console.log('Uploaded a blob or file!');
      });
    }
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
