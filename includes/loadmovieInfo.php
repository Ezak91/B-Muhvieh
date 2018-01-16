<?php
include "../conf/conf_db.php";
$tmdbid = $_POST["tmdbid"];
$action = $_POST["action"];

if($action == "movie") {
  $query = $mysqli->query("SELECT * from movie  where tmdb_id = $tmdbid");
}
if($action == "actor") {
  $query = $mysqli->query("SELECT * from cast JOIN actor ON cast.actor_id = actor.id where cast.movie_id = $tmdbid ORDER BY cast.cast_order ASC LIMIT 6");
}
if($action == "crew") {
  $query = $mysqli->query("SELECT * from job JOIN crew ON job.crew_id = crew.id where job.movie_id = $tmdbid AND job.job in ('Director','Screenplay','Novel','Executive Producer') LIMIT 6");
}
if($action == "genre") {
  $query = $mysqli->query("SELECT * from movie_genre JOIN genre ON movie_genre.genre_id = genre.id where movie_genre.tmdb_id = $tmdbid");
}

$rows = array();
while($result = mysqli_fetch_assoc($query)) {
    $rows[] = $result;
}
print json_encode($rows);
?>
