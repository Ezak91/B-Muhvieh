<?php
  include("../conf/conf_db.php");
  include("functions.php");

  $user_id = $_GET["userid"];
  $token = $_GET["token"];

  $query = "Select * from verified where userID = $user_id;";
  $result = $mysqli->query($query);

  if(!$result) {
    redirect_with_message("../index.php","","Validation failed please try again.","danger");
  }
  else{
    $verified = $result->fetch_object();
    $dbtoken = $verified->token;

    if($dbtoken == $token) {
      $query = "Update user set active = 1 where id = $user_id;";
      $result = $mysqli->query($query) ;
      $query = "Delete from verified where userID = $user_id;";
      $result = $mysqli->query($query) ;

      redirect_with_message("../index.php","","Validation success. You can login now.","success");
    }
    else {
      redirect_with_message("../index.php","","Validation failed please try again.","danger");
    }
  }
?>
