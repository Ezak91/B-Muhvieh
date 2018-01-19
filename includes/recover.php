<?php
  include("conf/conf_db.php");

  $user_id = $_GET["userid"];
  $token = $_GET["token"];

  include("recoverpw.php");
?>
