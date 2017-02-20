
<!DOCTYPE html>
<html lang="en">
<script src="http://www.w3schools.com/lib/w3data.js"></script><div w3-include-html="content.html"></div>
<link rel="stylesheet" href="helper.css">
<head>
  <title>Home | Bison Swap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
      <a class="active mobile-hidden" href="./"><img border="0" alt="home" src="../img/logo-lq.png" width="238" height="50"/></a>

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
  <h1><b>Add Item Form</b></h1>
  <p>Upload item you wish to trade</p>
</div>


</div>


<div class="container" align = "center" style = "border:2px solid black; padding: 5px">
  <!--<h1><b>Add Item Form</b></h1>-->
  <form>
    <div class="form-group" align = "left">
      <label for="itemname">Item Name</label>
      <input type="itemname" class="form-control" id="itemname">
    </div>
    <div class="form-group" align = "left">
      <label for="itemtype">Item Type</label>
      <input type="itemtype" class="form-control" id="itemtype">
    </div>
    <div class="form-group" align = "left">
  <label for="item-description">Item Description:</label>
  <textarea class="form-control" rows="5" id="item-description"></textarea>
</div>

    <div class = "container" align = "left">
    <button type = "Upload" class = "btn btn-default">Upload Image</button>
  </div>
    <button type="submit" class="btn btn-success">Submit</button>
  </form>
</div>



</body>
<script>
function addItem(userid, itemName, itemCategory, itemDescription, date, itemPictures, rating) {
  var pushData = {
    userid: userid,
    itemName: itemName,
    itemCategory: itemCategory,
    itemDescription: itemDescription,
    date: date,
    itemPictures: itemPictures,
    rating: rating
  };
  var newPushKey = firebase.database().ref().child('items').push().key;
  var updates = {};
  updates['/items/' + newPushKey] = pushData;
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
