<?php
  if(isset($_GET['message']) && isset($_GET['type'])){
    $type = $_GET['type'];
    $message = $_GET['message'];
    echo"
    <div class='container'>
      <div class='alert alert-$type alert-dismissable fade in'>
        <a href=''#'' class='close' data-dismiss='alert' aria-label='close'>×</a>
        $message
      </div>
    </div>";
  }
?>
