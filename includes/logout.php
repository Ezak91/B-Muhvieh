<?php
  session_start();
  include("functions.php");
  $_SESSION = array();
  session_destroy();
  redirect_with_message("../index.php","","Logged out, see you soon!","success");
?>
