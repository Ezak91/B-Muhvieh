<?php

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
?>
