<?php
  include("../conf/conf_db.php");
  include("../conf/conf.php");
  include("functions.php");

  $email = $_POST["email"];

  $query = "Select * from user where email = '$email'";
  $result = $mysqli->query($query);

  if($result->num_rows < 1) {
    redirect_with_message("../index.php","","Email ".$email." not found.","danger");
  }
  else {
    $user = $result->fetch_object();
    $userID = $user->id;
    $mail = $user->email;
    $token = md5(uniqid($userID, true));
    $query = "INSERT INTO recover VALUES ($userID,'$token')";
    $result = $mysqli->query($query);

    //send mail to to reset the password
    $subject = 'New password for B-Muhvieh';
    $message = 'Follow the link to reset your password : '.$BASE_URL.'/index.php?inc=recover.php&userid='.$userID.'&token='.$token;
    $header = 'From: '.$WEBMASTER . "\r\n" .
        'Reply-To: '.$WEBMASTER . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($mail, $subject, $message, $header);
    redirect_with_message("../index.php","","Reset password, please check your emails","info");
  }

?>
