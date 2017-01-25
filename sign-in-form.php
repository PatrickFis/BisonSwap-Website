<div class="row">
    <div class="col-sm-6">
        <div class="form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
        <div class="col-sm-12">
          <div class="form-group">
            <h2 class="">Sign In.</h2>
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
          <div class="form-group">
            <hr />
          </div>
          <div class="form-group">
            <a href="register.php">Sign Up Here...</a>
          </div>
        </div>
      </form>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

     <div class="col-md-12">

         <div class="form-group">
             <h2 class="">Sign Up.</h2>
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

            <!-- This is the secret question/answer portion. -->
            <!-- <div class="form-group">
              <select class = "selectpicker" name="questions">
                <option name="opt1">What was the name of your first pet?</option>
                <option name="opt2">What was the name of your best friend in high school?</option>
              </select>
              <br/>
              <div class="input-group">
                 <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
              <input type="text" name="secretans" class="form-control" placeholder="Enter secret answer" maxlength="100" />
              </div>
              <span class="text-danger"><//?php echo $secretError; ?></span>
            </div> -->

            <div class="form-group">
             <hr />
            </div>

            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>

            <div class="form-group">
             <hr />
            </div>

            <div class="form-group">
             <a href="login.php">Sign in Here...</a>
            </div>
        </div>
    </form>
        </div>
    </div>

</div>