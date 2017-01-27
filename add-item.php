
<!DOCTYPE html>
<html lang="en">
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
  <h1>Bison Swap</h1>
  <p>Trade your unwanted possessions with fellow Bisons that may want them.</p>
</div>

<content>
  <form>
    <fieldset>
    <label class = "labelone" for = "name">Item Name: </label>
    <input name="name"/>
    <br>
    <label for = "email">Email: </label>
    <input name = "email"/><br>
    <br>
    <label for = "description">Item Description: </label>
    <br>
    <textarea name="comments"></textarea>

    </fieldset>
    <fieldset>
      <h2><a href = "MessageReceived.html">Submit Item</a></h2>
<!--
      <input class = "btn" type = "submit" value = "Send Email"/>
      <input class = "btn" type = "reset" value = "Reset Form" />
    -->
    </fieldset>
  </form>
</content>

</div>

</body>
</html>