<?php
session_start();

if(!isset($_SESSION["userid"])) {
  $_GET["inc"] = "login.html";
}
else {
  if(!isset($_GET["inc"])) {
    $_GET["inc"] = "movies.php";
  }
}
include("includes/main.php");
?>
