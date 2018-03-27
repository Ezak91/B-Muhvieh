<?php
include "../conf/conf.php";
include "../conf/conf_db.php";

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

//add a movie to watchlist
function add_watch_movie($movie_id, $user_id) {
  global $mysqli;

  $query = "Insert into watch values(
    $user_id,
    $movie_id
  );";

  $mysqli->query($query);

}

// download image (cover,profile)
function download_image($path,$image) {
  if(!empty($image)) {
    $url = 'http://image.tmdb.org/t/p/original'.$image;
    $img = '../images/'.$path.$image;
    file_put_contents($img, file_get_contents($url));
  }
}

function delete_movie($user_id,$tmdb_id,$list) {
  global $mysqli;

  if($list == "user") {
    $query = "Delete from user_movie where user_id = $user_id AND tmdb_id = $tmdb_id;";
  }
  if($list == "watch") {
    $query = "Delete from watch where user_id = $user_id AND tmdb_id = $tmdb_id;";
  }
  $mysqli->query($query);
}

?>
