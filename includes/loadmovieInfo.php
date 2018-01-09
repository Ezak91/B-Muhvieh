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

$rows = array();
while($result = mysqli_fetch_assoc($query)) {
    $rows[] = $result;
}
print json_encode($rows);
?>
