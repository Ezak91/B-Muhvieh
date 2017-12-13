<nav class="navbar-default">
 <div class="container-fluid">
   <div class="navbar-header">
     <a class="navbar-brand" href="#">B-Muhvieh</a>
     <img src="images/main_logo.png" height="50" width="50"/>
   </div>
   <ul class="nav navbar-nav">
     <li><a href="index.php?inc=movies.php"><span class="glyphicon glyphicon-facetime-video"></span> My Movies</a></li>
     <li><a href="index.php?inc=watchlist.php"><span class="glyphicon glyphicon-eye-open"></span> Watchlist</a></li>
     <li><a href="index.php?inc=search.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
   </ul>
   <ul class="nav navbar-nav navbar-right">
       <?php
       if(isset($_SESSION["userid"])) {
         echo"<li><a id='logout-nav-link' href='includes/logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>";
       }
       else
       {
         echo"<li><a id='login-nav-link' href='#'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
         echo"<li><a id='register-nav-link' href='#'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>\r\n";
       }
       ?>
  </ul>
 </div>
</nav>
