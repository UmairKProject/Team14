<?php
include ("db_connect.php");

?>



<html>
<html lang="en">
<head>
<title>My Account</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
  body, html {
    font-family: "Lato", sans-serif;
    height: 100%;
    margin: 0;
  }
  
  .mySlides {display: none}

  .bg {
  /* The image used */
  background-image: url("images/Electric1.jpg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}


.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}


.img-comp-container {
  position: relative;
  height: 200px; /*should be the same height as the images*/
}
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script type="text/javascript" src="js/scrolltopcontrol.js">

/***********************************************
* Scroll To Top Control script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Please keep this notice intact
* Visit Project Page at http://www.dynamicdrive.com for full source code
***********************************************/

</script>
</head>
<body>

<nav class="navbar navbar-default">
  <a class="navbar-brand" href="Index.html">
    <img src="Images/Logo.png" alt="logo" style="width:120px;">
  </a>
  <div class="container-fluid">
    <div class="navbar-header">

    <ul class="nav navbar-nav">
      <li><a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
      <li><a href="Products.php">Products</a></li>
      <li class="active"><a href="My Account.php">My Account</a></li>
      <li><a href="Contact Us.php">Contact Us</a></li>
      <li><a href="About Us.php">About Us</a></li>
    </ul>
    <form class="navbar-form navbar-left" action="/action_page.php">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
    </form>
  </div>
</nav>



<footer class="w3-container w3-padding-64 w3-center w3-light-grey w3-xlarge">
  <p>Follow us on social media</p>
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <p class="w3-smal"></p> 2022-2023</p>
  <p class="w3-medium">Designed By: <a href="Index.html" target="_blank">Team Number 14</a></p>
</footer>
  
  </body>
  </html>