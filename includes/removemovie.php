<?php
  session_start();
  include("sqlfunctions.php");
  include("functions.php");

  $tmdb_id = $_GET["tmdbid"];
  $list = $_GET["list"];
  $user_id = $_SESSION["userid"];

  delete_movie($user_id,$tmdb_id,$list);
  if($list == "user") {
    redirect_with_message("../index.php","","Movie deleted succesfull.","info");
  }
  if($list == "watch") {
    redirect_with_message("../index.php","watchlist.php","Movie unwatched.","info");
  }
  ?>
