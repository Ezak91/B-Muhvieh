<?php
  session_start();
  include("../conf/conf_db.php");
  include("functions.php");

  $username = $_POST["username"];
  $password = $_POST["password"];

  $query = "Select * from user where username = '$username'";

  if ($result = $mysqli->query($query)) {
    $user = $result->fetch_object();
    $pw = $user->password;
    $active = $user->active;
    if( password_verify($password, $pw)  )
    {
      if($active != 1) {
        redirect_with_message("../index.php","","Please first verify your account.","danger");
      }
      else {
        $_SESSION["userid"] = $user->id;
        $_SESSION["username"] = $user->username;
        redirect_with_message("../index.php","movies.php","Welcome Back ".$user->username,"success");        
      }
    }
    else
    {
      login_error();
    }
    $result->close();
  }
  else {
    login_error();
  }
?>
