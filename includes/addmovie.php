<?php
  session_start();
  include("functions.php");

  $tmdb_id = $_GET["tmdbid"];
  $user_id = $_SESSION["userid"];

  $movieInfo = get_movieinfo_byid($tmdb_id);
  $castInfo = get_cast_byid($tmdb_id);

  insert_movie($movieInfo);
  insert_cast($castInfo,$tmdb_id);
  insert_crew($castInfo,$tmdb_id);
  insert_genre($movieInfo,$tmdb_id);
  add_user_movie($tmdb_id,$user_id);
  redirect_with_message("../index.php","",$movieInfo->title." added to movies.","info");
  //echo "Insert : $ret";
?>
