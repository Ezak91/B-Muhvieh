<?php
if(!isset($_SESSION["userid"])) {
  echo "You are not allowed to see this";
}
else {
  echo "Movies from ".$_SESSION["username"];
}
?>
