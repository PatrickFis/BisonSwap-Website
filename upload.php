<?php
$error_messages = [];

// check if the form was submitted
if (!empty($_GET['submit'])) {
  $valid = true;
  $uid = $_POST['uid'];
  // echo $_POST['uid'];

  // check if there are values in $_POST
  if (!isset($_POST['submit'])) {
    // the form was submitted but post is empty - the max size was exceeded
    $error_messages[] = 'The file was too large.';
    $valid = false;
  }
  else {

    // see http://php.net/manual/en/features.file-upload.errors.php
    if ($_FILES["fileToUpload"]['error'] != UPLOAD_ERR_OK) {
      switch ($_FILES["fileToUpload"]['error']) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:  $error_messages[] = 'The uploaded file was too large.'; $valid = false; break;
        case UPLOAD_ERR_PARTIAL:    $error_messages[] = 'The uploaded file was only partially received.'; $valid = false; break;
        case UPLOAD_ERR_NO_FILE:    $error_messages[] = 'No file was selected.'; $valid = false; break;
        case UPLOAD_ERR_NO_TMP_DIR: $error_messages[] = 'Missing temporary folder.'; $valid = false; break;
        case UPLOAD_ERR_CANT_WRITE: $error_messages[] = 'Failed to write file to disk.'; $valid = false; break;
        case UPLOAD_ERR_EXTENSION:  $error_messages[] = 'The server stopped the upload.'; $valid = false; break;
      }
    }

    if ($valid) {
      $target_dir = "uploads/";
      //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $target_file = $target_dir . 'images~' . $uid . '~' . basename($_FILES["fileToUpload"]["name"]);
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        $error_messages[] = "File is an image - " . $check["mime"] . ".";
      } else {
        $error_messages[] = "File is not an image.";
        $valid = false;
      }
      // Check if file already exists
      if (file_exists($target_file)) {
        $error_messages[] = "Sorry, file already exists.";
        $valid = false;
      }
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000000) {
        $error_messages[] = "Sorry, your file is too large.";
        $valid = false;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        $error_messages[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $valid = false;
      }
      // Check if $valid is set to false by an error
      if ($valid == false) {
        $error_messages[] = "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $error_messages[] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            $error_messages[] = "Sorry, there was an error uploading your file.";
        }
      }
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<script src="http://www.w3schools.com/lib/w3data.js"></script><div w3-include-html="content.html"></div>
<head>
  <title>Add Item | Bison Swap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/helper.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<html>
<body>
  <?php include 'navbar.php'; ?>
  <?php //echo implode('<br>', $error_messages); ?>

  <div class="container">
    <div class="rows">
      <div class="col-sm-8">
        <div class="form">
          <form action="upload.php?submit=true" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <h2 class="">Upload your item information</h2>
              <p>Your item will be removed after 14 days if no offers have been accepted.
                Offers will be automatically retracted after 72 hours unless the owner
                extends their offer.</p>
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
                  <option>Home Goods</option>
                  <option>Electronics</option>
                  <option>Clothing</option>
                  <option>Miscellaneous</option>
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
              <input type='text' name='uid' id='uid' class="hidden">
              <div class="form-group">
                <label for="item-description">Item Description:</label>
                <textarea class="form-control" rows="5" id="item-description"></textarea>
              </div>
              <div class="form-group">
                <p><b>Upload an image</b></p>
              </div>
              <div class="form-group">
                <input class="btn btn-default btn-file" type="file" name="fileToUpload" id="pic-1">
              </div>
      <div class="form-group">
        <hr />
      </div>
      <input type="submit" value="Submit" name="submit" onclick="addItem()">
      <!-- <button type="submit" class="btn btn-success" onclick="addItem()">Submit</button> -->
    </form>
  </div>
</div>
</div>
</div>
<!-- <form action="upload.php?submit=true" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type='text' name='uid' id='uid' class="hidden">
    <input type="submit" value="Upload Image" name="submit" onclick=sayHello()>
</form> -->

<script>
  $(document).ready(function () {
    alertEmail();
  });
</script>

<script>
  function alertEmail() {
    var user = firebase.auth().currentUser;
    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        // User is signed in.
        // console.log(user.email);
        document.getElementById('uid').value = user.uid;
        // console.log(user.uid);
        // alert(document.getElementById('uid').value);
      } else {
        // No user is signed in.
        console.log("?");
      }
    });
    // alert(user.email);
  }
</script>

<script>
function addItem() {
  var user = firebase.auth().currentUser;
  // var storageRef = firebase.storage().ref();
  var pic_1_name = document.getElementById("pic-1").value;
  // if(pic_1_name.length < 4) {
  //   pic_1_name = '0';
  // }
  /*else*/ pic_1_name = 'images~' + user.uid + '~' + pic_1_name.substring(pic_1_name.lastIndexOf('\\')+1, pic_1_name.length);
  var pushData = {
    email: user.email,
    itemName: document.getElementById("itemname").value,
    itemCategory: document.getElementById("cat").value,
    itemDescription: document.getElementById("item-description").value,
    date: new Date().getTime(),
    //itemPictures: document.getElementById("pic-1").value,
    pic_1: pic_1_name,
    rating: document.getElementById("condition").value,
    shipped: 0,
    arrived: 0,
    rated: 0,
    uid: user.uid
  };
  var newPushKey = firebase.database().ref().child('items').push().key;
  var updates = {};
  updates['/items/' + newPushKey] = pushData;
  // Get the first image uploaded by the user
  if(pic_1_name != '0') {
    var file1 = document.getElementById("pic-1").files[0];
    // var uploadTask = storageRef.child(pic_1_name).put(file1);
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
</body>
</html>
