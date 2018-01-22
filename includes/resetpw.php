<?php
  include("../conf/conf_db.php");
  include("functions.php");

  $token = $_POST["token"];
  $userid = $_POST["userid"];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $query = "Select * from recover where user_id = $userid;";
  $result = $mysqli->query($query);

  if(!$result) {
    redirect_with_message("../index.php","","Recover failed please try again.","danger");
  }
  else{
    $recover = $result->fetch_object();
    $dbtoken = $recover->token;

    if($dbtoken == $token) {
      $query = "Update user set password = '$password' where id = $userid";
      $result = $mysqli->query($query);
      $query = "Delete from recover where user_id = $userid";
      $result = $mysqli->query($query);
      redirect_with_message("../index.php","","Reset password success. Login now.","success");
    }
    else {
      redirect_with_message("../index.php","","Wrong token.","danger");
    }
  }

?>
