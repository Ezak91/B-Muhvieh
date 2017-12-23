<?php
  session_start();
  include("functions.php");
  include("sqlfunctions.php");

  $tmdb_id = $_GET["tmdbid"];
  $list = $_GET["list"];
  $user_id = $_SESSION["userid"];

  $movieInfo = get_movieinfo_byid($tmdb_id);
  $castInfo = get_cast_byid($tmdb_id);

  //add movie to database
  insert_movie($movieInfo);
  insert_cast($castInfo,$tmdb_id);
  insert_crew($castInfo,$tmdb_id);
  insert_genre($movieInfo,$tmdb_id);

  //add movie to userlist
  if($list == "user") {
    add_user_movie($tmdb_id,$user_id);
    redirect_with_message("../index.php","",$movieInfo->title." added to movies.","info");
  }

  //add movie to watchlist
  if($list == "watch") {
    redirect_with_message("../index.php","watchlist",$movieInfo->title." added to watchlist.","info");
  }
?>
