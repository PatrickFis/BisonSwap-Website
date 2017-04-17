<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo $iName; ?> | Bison Swap</title>
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
    <div id="test">
      <div class="row" id="replace">
        <!-- Content replaced with JS -->
      </div>
    </div>
  </div>
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
      function Item(date, email, itemCategory, itemDescription, itemName, pic_1, rating) {
        this.date = date;
        this.email = email;
        this.itemCategory = itemCategory;
        this.itemDescription = itemDescription;
        this.itemName = itemName;
        this.pic_1 = pic_1;
        this.rating = rating;
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
          childSnapshot.val().rating);
          var item = new Item(
            childSnapshot.val().date,
            childSnapshot.val().email,
            childSnapshot.val().itemCategory,
            childSnapshot.val().itemDescription,
            childSnapshot.val().itemName,
            childSnapshot.val().pic_1,
            childSnapshot.val().rating
          );
          items.push(item);
        });
        localStorage.setItem("Item", JSON.stringify(items));
        console.log(items);

        var string = "";
        for(var i = 0; i < items.length; i++) {
          string += '<div class="col-md-4 portfolio-item">';
          string += '<a href="#">';
          string += '<img class="img-responsive" src="http://placehold.it/700x400" alt="">';
          string += '</a>';
          string += '<h3>';
          string += '<a href="#">'+items[i].itemName+'</a>';
          string += '</h3>';
          string += '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>';
          string += '</div>';
        }
        document.getElementById("replace").innerHTML = string;
        // var newDiv = document.createElement("div");
        // newDiv.appendChild(document.createTextNode(string));
        // var replaceDiv = document.getElementById("test");
        // document.body.insertBefore(newDiv, replaceDiv);
      });
    </script>
    <script src="web/scripts/auth.js"></script>
</body>

</html>
