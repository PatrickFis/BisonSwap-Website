<?php
ob_start();
session_start();
require_once 'dbconnect.php';
// include 'forgotpass.php';
// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user'])!="" ) {
  header("Location: Main.php");
  exit;
}

$error = false;

if( isset($_POST['btn-login']) ) {

  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs

  if(empty($email)){
    $error = true;
    $emailError = "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
    $error = true;
    $emailError = "Please enter valid email address.";
  }

  if(empty($pass)){
    $error = true;
    $passError = "Please enter your password.";
  }

  // if there's no error, continue to login
  if (!$error) {

    $password = hash('sha256', $pass); // password hashing using SHA256

    $res=mysql_query("SELECT idusers, email, password FROM users WHERE email ='$email'");
    $row=mysql_fetch_array($res);
    $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

    if( $count == 1 && $row['password']==$password ) {
      $_SESSION['user'] = $row['idusers'];
      header("Location: Main.php");
    } else {
      $errMSG = "Incorrect Credentials, Try again...";
    }

  }

  if ( isset($_POST['btn-signup']) ) {

    // clean user inputs to prevent sql injections
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    //basic email validation
    if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
     $error = true;
     $emailError = "Please enter valid email address.";
    } else {
     // check email exist or not
     $query = "SELECT email FROM users WHERE email ='$email'";
     $result = mysql_query($query);
     $count = mysql_num_rows($result);
     if($count!=0){
      $error = true;
      $emailError = "Provided Email is already in use.";
     }
    }
    // password validation
    if (empty($pass)){
     $error = true;
     $passError = "Please enter password.";
    } else if(strlen($pass) < 8) {
     $error = true;
     $passError = "Password must have at least 8 characters.";
    }

    // Checking if the user has supplied an answer to their secret question

    // if(empty($secretAns)) {
    //   $error = true;
    //   $secretError = "Please enter an answer.";
    // }
    // password encrypt using SHA256();
    $password = hash('sha256', $pass);

    // if there's no error, continue to signup
    if( !$error ) { 
    //  $selectOption = $_POST['questions']; // Get secret question
     $query = "INSERT INTO users(email,password) VALUES('$email','$password')";
     $res = mysql_query($query);

     if ($res) {
      $errTyp = "success";
      $errMSG = "Successfully registered, you may login now";
      unset($email);
      unset($pass);
      // unset($secretans);
     } else {
      $errTyp = "danger";
      $errMSG = "Something went wrong, try again later...";
     }
    }
   }

  // Used to reset a user's password
  if(isset($_POST['btn-reset'])) {
    // Get the email supplied by the user and prevent SQL injections
    print("This actually worked...");
  }
}
?>

<script>
/* must apply only after HTML has loaded */
$(document).ready(function () {
    $("#resetModal").on("submit", function(e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
            url: formURL,
            type: "POST",
            data: postData,
            success: function(data, textStatus, jqXHR) {
                $('#contact_dialog .modal-header .modal-title').html("Result");
                $('#contact_dialog .modal-body').html(data);
                $("#submitForm").remove();
            },
            error: function(jqXHR, status, error) {
                console.log(status + ": " + error);
            }
        });
        e.preventDefault();
    });

    $("#btn-reset").on('click', function() {
        $("#resetModal").submit();
    });
});

</script>

<div class="row">
  <div class="col-sm-6">
    <div class="form">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
        <div class="form-group">
          <h2 class="">Already a member? Sign in:</h2>
        </div>
        <div class="form-group">
          <hr />
        </div>
        <?php
        if ( isset($errMSG) ) {
          ?>
          <div class="form-group">
            <div class="alert alert-danger">
              <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
            </div>
          </div>
          <?php
        }
        ?>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
          </div>
          <span class="text-danger"><?php echo $emailError; ?></span>
        </div>
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
          </div>
          <span class="text-danger"><?php echo $passError; ?></span>
        </div>
        <div class="form-group">
          <hr />
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
        </div>
        <div class="form-group text-center">
          <a href="#" data-target="#pwdRstModal" data-toggle="modal">Forgot my password</a>
        </div>
        <div class="modal fade" id="pwdRstModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Reset your password</h2>
              </div>
              <div class="modal-body">
              <p>Enter your email address and we will send you a link to reset your password.</p>
              <br>
              <form>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
        </div>
        <div class="form-group">
          <hr />
        </div>
      </form>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
        <div class="form-group">
          <h2 class="">Create a new account</h2>
        </div>

        <div class="form-group">
          <hr />
        </div>

        <?php
        if ( isset($errMSG) ) {
        ?>
        <div class="form-group">
          <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
          </div>
        </div>
        <?php
        }
        ?>

        <div class="form-group">
         <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
         <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="255" value="<?php echo $email ?>" />
            </div>
            <span class="text-danger"><?php echo $emailError; ?></span>
        </div>

        <div class="form-group">
         <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
         <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="255" />
            </div>
            <span class="text-danger"><?php echo $passError; ?></span>
        </div>
        <div class="form-group">
         <hr />
        </div>

        <div class="form-group">
         <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
        </div>

        <div class="form-group">
         <hr />
        </div>
      </form>
    </div>
  </div>
</div>