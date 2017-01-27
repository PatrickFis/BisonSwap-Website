<div class="row">
    <div class="col-sm-6">
        <div class="form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
        <div class="col-sm-12">
          <div class="form-group">
            <h2 class="">Already a member? Sign in:.</h2>
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
        </div>
      </form>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

     <div class="col-md-12">

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
        </div>
    </form>
        </div>
    </div>

</div>