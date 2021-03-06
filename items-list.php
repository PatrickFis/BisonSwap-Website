<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Items | Bison Swap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/helper.css">
  <link rel="stylesheet" type="text/css" href="css/view-item.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <title>Shop Homepage</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/shop-homepage.css" rel="stylesheet">

</head>
<?php
    include 'navbar.php';
?>

<body>
  <div class="container">

  </div>
  <div class="row">
      <div class="col-lg-12 text-center">
          <h1 class="page-header">Items for Trade
              <small>Be sure to upload your own!</small>
          </h1>
      </div>
  </div>
  <div class="container">
    <div id="test">
      <div class="row" id="replace">
        <!-- Content replaced with JS -->
      </div>
    </div>
  </div>
</body>
  <?php
    include 'footer.php';
   ?>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
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
      function Item(date, email, itemCategory, itemDescription, itemName, pic_1, rating, url, key, offer) {
        this.date = date;
        this.email = email;
        this.itemCategory = itemCategory;
        this.itemDescription = itemDescription;
        this.itemName = itemName;
        this.pic_1 = pic_1;
        this.rating = rating;
        this.url = url;
        this.key = key;
        this.offer = offer;
      }
      firebase.database().ref('/items/').once('value').then(function(snapshot) {
        var items = [];
        snapshot.forEach(function(childSnapshot) {
          console.log(childSnapshot.val().date,
          childSnapshot.val().email,
          childSnapshot.val().itemCategory,
          childSnapshot.val().itemDescription,
          childSnapshot.val().itemName,
          childSnapshot.val().pic_1,
          childSnapshot.val().rating,
          childSnapshot.val().url,
          childSnapshot.key,
          childSnapshot.val().offer);
          var item = new Item(
            childSnapshot.val().date,
            childSnapshot.val().email,
            childSnapshot.val().itemCategory,
            childSnapshot.val().itemDescription,
            childSnapshot.val().itemName,
            childSnapshot.val().pic_1,
            childSnapshot.val().rating,
            childSnapshot.val().url,
            childSnapshot.key,
            childSnapshot.val().offer
          );
          items.push(item);
        });
        localStorage.setItem("Item", JSON.stringify(items));
        console.log(items);

        var string = "";
        for(var i = 0; i < items.length; i++) {
          // Do not display any items that have accepted offers
          var accept = 0;
          if(items[i].offer != null) {
            console.log("NOT NULL");
            var off_key = Object.keys(items[i].offer);
            console.log(off_key);
            for(var j = 0; j < off_key.length; j++) {
              if(items[i].offer[off_key[j]].accepted == "1") {
                accept = 1;
              }
            }
          }
          if(accept == 1) {
            continue;
          }
          string += '<div class="col-md-4 portfolio-item">';
          string += '<a href="item.php?key='+items[i].key+'">';
          // Replace src with image from database
          string += '<img height=300 width=250 src="uploads/'+items[i].pic_1+'" id ="pic_'+i+'" alt="">';
          string += '</a>';
          string += '<h3>';
          string += '<a href="item.php?key='+items[i].key+'">'+items[i].itemName+'</a>';
          string += '</h3>';
          string += '<p>'+items[i].itemDescription+'</p>';
          string += '<p> Category: '+items[i].itemCategory+'</p>';
          string += '<p> Rating: '+items[i].rating+'</p>';
          // string += '<div hidden>'+items[i].key+'</div>';
          string += '</div>';
        }
        document.getElementById("replace").innerHTML = string;
      });
    </script>
    <script src="web/scripts/auth.js"></script>
</body>

</html>
