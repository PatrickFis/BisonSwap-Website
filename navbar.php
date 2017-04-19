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
          <a href="offers.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Your Offers<span class="caret"></span></a>
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
