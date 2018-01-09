<?php
include "../conf/conf_db.php";
$tmdbid = $_POST["tmdbid"];

$query = $mysqli->query("SELECT * from movie  where tmdb_id = $tmdbid");

$rows = array();
while($result = mysqli_fetch_assoc($query)) {
    $rows[] = $result;
}
print json_encode($rows);
?>
