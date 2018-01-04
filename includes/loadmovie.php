<?php
include "../conf/conf_db.php";
$userid = $_POST["userid"];
$list = $_POST["list"];
if($list == "user") {
  $query = $mysqli->query("SELECT * from user_movie JOIN movie ON user_movie.tmdb_id = movie.tmdb_id where user_movie.user_id = $userid");
}
if($list == "watch") {
  $query = $mysqli->query("SELECT * from watch JOIN movie ON watch.tmdb_id = movie.tmdb_id where watch.user_id = $userid");
}
$rows = array();
while($result = mysqli_fetch_assoc($query)) {
    $rows[] = $result;
}
print json_encode($rows);
?>
