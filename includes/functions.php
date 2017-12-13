<?php
include "../conf/conf.php";
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
function get_movieinfo_byid($tmdbID) {
  global $APIKEY;
  global $API_BASE_URL;
  global $LANGUAGE;
  $path = "movie/$tmdbID?&api_key=$APIKEY&language=$LANGUAGE&append_to_response=trailers";
  return json_encode(json_decode(file_get_contents($BASE_API_URL.$path)), JSON_PRETTY_PRINT);

}

//get cast info by movie id
function get_cast_byid($tmdbID) {
  global $APIKEY;
  global $API_BASE_URL;
  global $LANGUAGE;
  $path = "/movie/$dmdbID/credits?&api_key=$APIKEY&language=$LANGUAGE";
  return json_encode(json_decode(file_get_contents($BASE_API_URL.$path)), JSON_PRETTY_PRINT);
}

// Search Movies by title
function search_movies_by_name($term) {
  global $APIKEY;
  global $API_BASE_URL;
  global $LANGUAGE;
  $path = "search/movie?api_key=$APIKEY&language=$LANGUAGE&query=".urlencode($term);
  return json_encode(json_decode(file_get_contents($API_BASE_URL.$path)), JSON_PRETTY_PRINT);
}
?>
