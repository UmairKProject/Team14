<?php
include 'config.php';
$customerID = $_SESSION['customerID'];

if(isset($_POST['send'])){
  $email = mysqli_real_escape_string($link, $_POST['email']);
  $name = mysqli_real_escape_string($link, $_POST['name']);
  $subject = mysqli_real_escape_string($link, $_POST['subject']);
  $message = mysqli_real_escape_string($link, $_POST['message']);

  $selectMessage = mysqli_query($link, "SELECT * FROM `contactus` WHERE name = '$name' AND email = '$email' AND subject = '$subject' AND message = '$message'") or die('query failed');

  if(mysqli_num_rows($selectMessage) > 0){
     $message[] = 'message sent already!';
  }else{
     mysqli_query($lnik, "INSERT INTO `contactus`(customerID, name, email, subject, message) VALUES('$customerID', '$name', '$email', '$subject', '$message')") or die('query failed');
     $message[] = 'Message sent successfully!';
  }

}

?>
<!DOCTYPE html>
<html lang="en">
<title>Contact Us | Here you can contact Us</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/contactUs.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<head>
  <?php include 'header.php'; ?>
</head>

<body>
<div class="sidebar">
    <h1 class="sideh1">Our Contact details</h1>
    <p class="sidep">Email address: team14@aston.ac.uk</p>
    <p class="sidep">Address: Aston University B4 7ET</p>
    <P class="sidep">Phone: 07100000000</P>
    <p class="sidep">Any Question? feel free to contact</p>
  </div>
  <form class="contact" method="post" action="">
    <h1>Contact Form</h1>
    <div class="fields">
      <label for="email">
        <i class="fas fa-envelope"></i>
        <input id="email" type="email" name="email" placeholder="Your Email" required>
      </label>
      <label for="name">
        <i class="fas fa-user"></i>
        <input type="text" name="name" placeholder="Your Name" required>
        <label>
          <input type="text" name="subject" placeholder="Subject" required>
          <textarea name="msg" placeholder="Message" required></textarea>
    </div>
    <input name="send" type="submit">
  </form>
  
  <?php include 'footer.php'; ?>

</body>

</html>