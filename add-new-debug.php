
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
  <nav class="navbar navbar-inverse container-fluid">
  <div class="container">
    <div class="navbar-left">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="active mobile-hidden" href="./"><img border="0" alt="home" src="../img/logo-lq.png" width="70" height="50"/></a>

    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav">
        <li><a href="/web/chat.html">Chat<span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="dancehall.php">Home Goods</a></li>
            <li><a href="gospel.php">Electronics</a></li>
            <li><a href="hiphop.php">Clothing</a></li>
            <li><a href="drama.php">Books</a></li>
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
        <li><a href="add-new-item.php">Upload Item</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Your Offers<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="upload-youtube-video.php">Sub Link 1</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="create-profile.php">Sub Link 2</a></li>
          </ul>
        </li>
        <li><a id="user-name"></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu">
            <li><a id="sign-in"><!--i class="material-icons">account_circle</i-->Sign-in</a></li>
            <li><a href="">My Account</a></li>
            <li><a href="history.php">Trade History</a></li>
            <li><a id="sign-out">Sign-out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <script type="text/javascript" src="http://code.jquery.com/jquery-git2.min.js" ></script>
  <script>
    $(function(){
      $('.input').keyup(function(){
        var search = $('.input').val();
        $.post("liveSearchResults.php",{"search":search},function(data){
          $('.entry').html(data);
        });
      });
    });
  </script>
  <script>
    $(function(){
      $('.miniinput').keyup(function(){
        var search = $('.miniinput').val();
        $.post("liveSearchResultsMobile.php",{"search":search},function(data){
          $('.minientry').html(data);
        });
      });
    });
  </script>

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
    <button type="submit" class="btn btn-success" onclick="addItem_II()">Submit</button>
  </form>
</div>
</div>
</div>
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
<script src="web/scripts/auth.js"></script>
<script>
// var downloadURL = "";
function addItem_II() {
  var user = firebase.auth().currentUser;
  var pic_1_name = document.getElementById("pic-1").value;
  if(pic_1_name.length < 4) {
    pic_1_name = '0';
  }
  else pic_1_name = '/images/' + user.uid + '/' + document.getElementById("itemname").value + '/' + pic_1_name.substring(pic_1_name.lastIndexOf('\\')+1, pic_1_name.length);
  var storageRef = firebase.storage().ref(pic_1_name);
  var file1 = document.getElementById("pic-1").files[0];
  var uploadTask = storageRef.put(file1);

  uploadTask.on('state_changed', function(snapshot){
    
  }, function(error) {
  
  }, function() {
      var downloadURL = uploadTask.snapshot.downloadURL;
      var newPushKey = firebase.database().ref('items').push().key;
      var updates = {};
      var pushData = {
        url: downloadURL,
        user: user.uid
      };
      updates['/items/' + newPushKey] = pushData;
      firebase.database().ref().update(updates);
      // console.log(downloadURL);
  });
}
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
  // Get the first image uploaded by the user
  if(pic_1_name != '0') {
    var file1 = document.getElementById("pic-1").files[0];
    // storageRef.child(pic_1_name).put(file1).then(function(snapshot) {
    //   console.log('Uploaded a blob or file!');
    //   // console.log('Download URL:');
    //   // console.log(snapshot.downloadURL);
    //   });
    alert("HERE")
    var downloadURL = "";
      var uploadTask = storageRef.child(pic_1_name).put(file1);
      // Register three observers:
      // 1. 'state_changed' observer, called any time the state changes
      // 2. Error observer, called on failure
      // 3. Completion observer, called on successful completion
      uploadTask.on('state_changed', function(snapshot){
        // Observe state change events such as progress, pause, and resume
        // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
        console.log('Upload is ' + progress + '% done');
        switch (snapshot.state) {
          case firebase.storage.TaskState.PAUSED: // or 'paused'
            console.log('Upload is paused');
            break;
          case firebase.storage.TaskState.RUNNING: // or 'running'
            console.log('Upload is running');
            console.log(uploadTask.snapshot.downloadURL);
            break;
          case firebase.storage.TaskState.SUCCESS:
            console.log('Upload successful');
            break;
        }
      }, function(error) {
        // Handle unsuccessful uploads
        console.log("ERROR");
      }, function() {
        // Handle successful uploads on complete
        // For instance, get the download URL: https://firebasestorage.googleapis.com/...
        downloadURL += uploadTask.snapshot.downloadURL;
        alert(downloadURL);
        firebase.database().ref('/items/' + newPushKey).update({url: downloadURL});
        // console.log(firebase.storage().ref(pic_1_name).getDownloadURL);

      });
    }
    var pushData = {
      email: firebase.auth().currentUser.email,
      itemName: document.getElementById("itemname").value,
      itemCategory: document.getElementById("cat").value,
      itemDescription: document.getElementById("item-description").value,
      date: new Date(),
      //itemPictures: document.getElementById("pic-1").value,
      pic_1: pic_1_name,
      rating: document.getElementById("condition").value,
      url: downloadURL
    };
    var newPushKey = firebase.database().ref().child('items').push().key;
    var updates = {};
    updates['/items/' + newPushKey] = pushData;
    firebase.database().ref().update(updates);
  }

</script>
</html>

