<?php
include "../conf/conf.php";
include "../conf/conf_db.php";
//login failed
function login_error()
{
  $target = "../index.php";
  $message = "Login failed! Please check username and password.";
  $type = "danger";
  redirect_with_message($target,"", $message, $type);
}

// redirect to a targetsite
function redirect($target, $inc)
{
  $include="";
  if(!empty($inc)) {
    $include = "?".$include.$inc."&";
  }
  echo "<script type='text/javascript'>window.location.href='$target$include'</script>";
}

// redirect with a message
function redirect_with_message($target, $inc, $message, $type) {
  $include="?";
  if(!empty($inc)) {
    $include = $include.$inc."&";
  }
  echo "<script type='text/javascript'>window.location.href='".$target.$include."message=$message&type=$type'</script>";
}

// TMDB functions

//Get movie info by movie id
function get_movieinfo_byid($tmdb_id) {
  global $APIKEY;
  global $API_BASE_URL;
  global $LANGUAGE;
  $path = "movie/$tmdb_id?&api_key=$APIKEY&language=$LANGUAGE&append_to_response=trailers";
  return json_decode(file_get_contents($API_BASE_URL.$path));

}

//get cast info by movie id
function get_cast_byid($tmdb_id) {
  global $APIKEY;
  global $API_BASE_URL;
  global $LANGUAGE;
  $path = "movie/$tmdb_id/credits?&api_key=$APIKEY&language=$LANGUAGE";
  return json_decode(file_get_contents($API_BASE_URL.$path));
}

// Search Movies by title
function search_movies_by_name($term) {
  global $APIKEY;
  global $API_BASE_URL;
  global $LANGUAGE;
  $path = "search/movie?api_key=$APIKEY&language=$LANGUAGE&query=".urlencode($term);
  return json_encode(json_decode(file_get_contents($API_BASE_URL.$path)), JSON_PRETTY_PRINT);
}

// Insert a movie into db
function insert_movie($movie) {
  global $mysqli;
  $trailer = "";
  $adult = 0;
  if(!empty($movie->trailers->youtube[0])) {
    $trailer = $movie->trailers->youtube[0]->source;
  }

  if($movie->adult) {
    $adult = 1;
  }

  $query = "Insert into movie values (
    $movie->id,
    '$movie->imdb_id',
    '$movie->title',
    '$movie->original_title',
    '$movie->release_date',
    '$movie->overview',
    '$movie->poster_path',
    '$movie->original_language',
    '$movie->backdrop_path',
    $movie->budget,
    $movie->revenue,
    $movie->runtime,
    $movie->vote_average,
    $movie->vote_count,
    '$trailer',
    $adult,
    '$movie->homepage'
  );";

  if (!$result = $mysqli->query($query)) {
    return $query;
  }
  else {
    download_image("cover",$movie->poster_path);
    download_image("backdrop",$movie->backdrop_path);
    return true;
  }
}

//insert casting into db
function insert_cast($peoble, $movie_id) {
  global $mysqli;
  $cast = $peoble->cast;

  foreach ($cast as &$actor) {
    $character = $mysqli->real_escape_string($actor->character);

    $actorQuery = "Insert into actor values (
      $actor->id,
      '$actor->name',
      '$actor->profile_path'
    );";

    $castQuery = "Insert into cast  values(
      $movie_id,
      $actor->id,
      '$character',
      $actor->order
    );";

    $mysqli->query($actorQuery);
    $mysqli->query($castQuery);
  }
}

//insert crew into db
function insert_crew($peoble, $movie_id) {
  global $mysqli;
  $crew = $peoble->crew;

  foreach ($crew as &$member) {

    $crewQuery = "Insert into crew values (
      $member->id,
      '$member->name',
      '$member->profile_path'
    );";

    $jobQuery = "Insert into job values(
      $movie_id,
      $member->id,
      '$member->job'
    );";

    $mysqli->query($crewQuery);
    $mysqli->query($jobQuery);
  }
}

//insert genre
function insert_genre($movie,$movie_id) {
  global $mysqli;
  $genres = $movie->genres;

  foreach($genres as &$genre) {

    $genreQuery = "Insert into genre values(
      $genre->id,
      '$genre->name'
    );";

    $genreMovieQuery = "Insert into movie_genre values(
      $movie_id,
      $genre->id
    );";

    $mysqli->query($genreQuery);
    $mysqli->query($genreMovieQuery);

  }
}

//add a movie to a userlist
function add_user_movie($movie_id, $user_id) {
  global $mysqli;

  $query = "Insert into user_movie values(
    $user_id,
    $movie_id
  );";

  $mysqli->query($query);

}

// download image (cover,profile)
function download_image($path,$image) {
  if(!empty($image)) {
    $url = 'http://image.tmdb.org/t/p/w500'.$image;
    $img = '../images/'.$path.$image;
    file_put_contents($img, file_get_contents($url));
  }
}

?>
