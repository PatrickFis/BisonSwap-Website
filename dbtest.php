<body>

  <button id="test" onclick="testFunction()">Test</button>
</body>

<script>
function testFunction() {
  var pushData = {
    test1: 0,
    test2: 1
  };
  var newPushKey = firebase.database().ref().child('test').push().key;
  var updates = {};
  updates['/test/' + newPushKey] = pushData;
  return firebase.database().ref().update(updates);
}
</script>
<script src="https://www.gstatic.com/firebasejs/3.6.9/firebase.js"></script>
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
  // Get a reference to the database service
  var database = firebase.database();
</script>
