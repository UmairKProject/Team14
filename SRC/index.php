<!DOCTYPE html>
<html lang="en">

<head>
  <title>MW4U | Look smart with MW4U products</title>
  <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="./assets/logos/favicon.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <?php
  require_once("connectDB.php");
  $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
  $rows = $db->query("SELECT * FROM products");
  ?>
  <!-- This is for the rollover images, hovering over, the image changes and shows the second image-->
  <script language="javascript">
    function MouseRollover(MyImage) {
      MyImage.src = "Images/building.jpg";
    }

    function MouseOut(MyImage) {
      MyImage.src = "Images/building1.jpeg";
    }
  </script>
</head>

<style>
  body {
    font-family: "Lato", sans-serif
  }

  .mySlides {
    display: none
  }

  .container {
    position: relative;
    width: 100%;
  }

  .image {
    display: block;
    width: 100%;
    height: auto;
    border-radius: 20px;
  }

  .overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: 100%;
    border-radius: 30px;

    opacity: 0;
    transition: .3s ease;
    background-color: #8d8d8d;
  }

  .container:hover .overlay {
    opacity: 1;
  }

  .text {
    color: #ffffff;
    font-size: 23px;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    text-align: center;
  }
</style>

<?php include("header.php"); ?>


<body onLoad="show_clock()">

  <div class="text-center">
    <br>
    <h3 style="font-size: xx-large;"> Pleased to meet you here</h3>
    <p>Look smart with MW4U products</p>
    <br>

    <!--This Java Script code would allow the user to see a live clock and see the exact time -->
    <script language="javascript" src="js/liveclock.js">
      /*
    Live Clock Script-
    By Mark Plachetta (astro@bigpond.net.au(c)) based on code from DynamicDrive.com
    For full source code, 100's more DHTML scripts, and Terms Of Use,
    visit http://www.dynamicdrive.com
    */
    </script>

    <br>
    <br>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>



    <!--This Java Script code would allow the user to push a button and automaticly scroll all the way up to the top of the page-->
    <script type="text/javascript" src="js/scrolltopcontrol.js">
      /***********************************************
       * Scroll To Top Control script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
       * Please keep this notice intact
       * Visit Project Page at http://www.dynamicdrive.com for full source code
       ***********************************************/
    </script>
  </div>

  <!--This section is to create my Carousel-->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
      <li data-target="#myCarousel" data-slide-to="5"></li>
    </ol>

    <!-- Wrapper for slides -->

    <div class="carousel-inner" role="listbox">
      <div class="item">
        <img src="Images/teen6.jpg" alt="Home page">
        <div class="carousel-caption">
          <h3>High quality, long lasting</h3>
          <P> <a href="Products.html">See more in product page</a></P>
        </div>
      </div>
      <div class="item active">
        <img src="Images/teen1.jpg" alt="Benz A class">
        <div class="carousel-caption">
          <h3>Buy your desired style</h3>
          <P> <a href="Products.html">See more in product page</a></P>
        </div>
      </div>

      <div class="item">
        <img src="Images/teen2.jpg" alt="Benz B class">
        <div class="carousel-caption">
          <h3>Easy way to look smart</h3>
          <P> <a href="Products.html">See more in product page</a></P>
        </div>
      </div>

      <div class="item">
        <img src="Images/teen3.jpg" alt="Benz C class">
        <div class="carousel-caption">
          <h3>To look great, you need a few click</h3>
          <P> <a href="Products.html">See more in product page</a></P>
        </div>
      </div>

      <div class="item">
        <img src="Images/teen4.jpg" alt="Electric cars">
        <div class="carousel-caption">
          <h3>Just explore MW4U</h3>
          <P> <a href="Products.html">See more in product page</a></P>
        </div>
      </div>

      <div class="item">
        <img src="Images/teen5.jpg" alt="Benz E class">
        <div class="carousel-caption">
          <h3>Beauty on the outside. Wellness on the inside.</h3>
          <P> <a href="Products.html">See more in product page</a></P>
        </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!-- The website description Section -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">

    <div class="w3-row w3-padding-32">
      <br>
      <div class="w3-third">
        <p><b><a href="productsCategory.php?id=1">Shoes</a></b></p>
        <img src="Images/teen7.jpg" class="Hot A class" alt="Random Name" style="width:90%">
      </div>
      <div class="w3-third">
        <p><b><a href="productsCategory.php?id=2">T-Shirt</a></b></p>
        <img src="assets/images/blackTee.jpg" class="w3-round" alt="Random Name" style="width:90%">
      </div>
      <div class="w3-third">
        <p><b><a href="productsCategory.php?id=3">Jeans</a></b></p>
        <img src="Images/teen9.jpg" class="w3-round w3-margin-bottom" alt="Random Name" style="width:90%">
      </div>
      <br>
      <br>
      <div class="w3-third">
        <p><b><a href="productsCategory.php?id=4">Caps</a></b></p>
        <img src="Images/teen10.jpg" class="w3-round" alt="Random Name" style="width:90%">
      </div>
      <div class="w3-third">
        <p><b><a href="productsCategory.php?id=5">Hoodies</a></b></p>
        <img src="Images/teen11.jpg" class="w3-round" alt="Random Name" style="width:90%">
      </div>
      <div class="w3-third">
        <p><b><a href="productsCategory.php?id=6">Shirts</a></b></p>
        <img src="Images/teen12.jpg" class="w3-round" alt="Random Name" style="width:90%">
        <br>
      </div>
    </div>
    <P><b> <a href="Products.php">See all products in Product pags</a></b></P>
  </div>

  <div class="container">
    <img src="Images/teen13.jpg" alt="Avatar" class="image">
  </div>
  </div>
  <br>
  <br>
  <br>

  <br>
  <!-- Image of location/map -->

  <div class="text-center">
    <div class="text-center">
      <h3 style="font-size: xx-large;">Find us in other locations</h3>


      <!--This Java Script code would allow the user to see a google map in the page and search other car manufactures in the world-->
      <!--google maps code-->

      <div id="googleMap" style="width:50px;height:50px;">
      </div>

      <script>
        function myMap() {
          var mapProp = {
            center: new google.maps.LatLng(51.508742, -0.120850),
            zoom: 5,
          };
          var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        }
      </script>

      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2430.048080853831!2d-1.897628284651387!3d52.47826514707445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bc88d94818e9%3A0x88b5cd24e7637041!2s148%20New%20St%2C%20Birmingham%20B2%204NY!5e0!3m2!1sen!2suk!4v1605212104422!5m2!1sen!2suk" width="1520" height="550" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

      <!-- end google maps code-->

      <?php include("footer.php") ?>

</body>

</html>