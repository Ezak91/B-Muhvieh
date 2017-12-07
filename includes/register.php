<?php
  include("../conf/conf_db.php");
  include("..cong/conf.php");

  $mail = $mysqli->real_escape_string($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $password = $mysqli->real_escape_string($password);
  $firstName = $mysqli->real_escape_string($_POST['firstname']);
  $name = $mysqli->real_escape_string($_POST['name']);
  $username = $mysqli->real_escape_string($_POST['username']);

  $query = "INSERT INTO user VALUES (NULL,'$mail','$password','$firstName','$name','$username',NOW(),0)";

  if (!$result = $mysqli->query($query)) {
    $alertMessage = "Registration failed please check your input";
    $type = "danger";
    echo "<script type='text/javascript'>window.location.href='../index.php?message=$alertMessage&type=$type'</script>";
  }
  else {
    //generate unique mail token to verify mail
    $userID = $mysqli->insert_id;
    $token = md5(uniqid($userID, true));
    $token = $mysqli->real_escape_string($token);


    $query = "INSERT INTO verified VALUES ($userID,'$token')";
    $result = $mysqli->query($query);

    //send mail to verify account
    // TODO TEST MAIL FUNCTION ON SERVER
    $subject = 'Your registration for B-Muhvieh';
    $message = 'Follow the link to verify your registration : '.$BASE_URL.'/verify.php?token='.$token;
    $header = 'From: '.$WEBMASTER . "\r\n" .
        'Reply-To: '.$WEBMASTER . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($mail, $subject, $message, $header);

    $alertMessage = "Registration success, please check your emails to verify your account";
    $type = "info";

    echo"<script type='text/javascript'>window.location.href='../index.php?message=$alertMessage&type=$type'</script>";
  }

?>
