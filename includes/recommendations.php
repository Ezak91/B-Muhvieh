<?php
include "../includes/functions.php";
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo get_recommendation_movies($_POST["tmdbid"]);
?>
