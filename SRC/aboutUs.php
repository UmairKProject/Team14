<!DOCTYPE html>
<html lang="en">

<head>
  <title>About Us</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<!--Css font-style for the body-->
<style>
  body {
    font-family: "Lato", sans-serif
  }
</style>

<header>
  <!-- Navbar class used to locat the navbar in the landing page -->
  <?php include 'header.php'; ?>
</header>

<body>

  <!--Title 1 -About US-->
  <div class="w3-container w3-padding-64 w3-center  w3-light-grey w3-xlarge">
    <h2>About Us</h2>
  </div>
  <!--Oraginsation Quote-->
  <div class="test">
    <p1>MW4U is a student-led organisation that was founded in 2022 by TEAM 14. </p1><br><br><br>
    <p1>"The services that we provide focuses on delivering the best clothing for our male customers. Our products
      were tailored by the finest craftsmen in the whole of the UK. We are currently one of the best market
      leaders in the clothing industry, and I can guarantee you would not be disappointed with the quality that we
      provide. Take a look though our products, I can assure you that you would not regret it." – Team 14</p1>
  </div>
  <!--Title 2 - Customer Reviews -->
  <div class="w3-container w3-padding-64 w3-center  w3-light-grey w3-xlarge">
    <h2>Customer Reviews</h2>
  </div>
  <!--Reviews-->
  <div class="reviews">
    <!--Review 1-->
    <div class="review1">
      <p1>"The customer support provided was outstanding, they were easy to talk to and were keen in helping me
        find the right size"- Jackson Wilson</p1>
    </div>
    <!--Review 2-->
    <div class="review2">
      <p1>"Comfy and stylish brand, I would 100% recommend to anyone who wants to spice up their style" - James
        Brandon</p1>
    </div>
    <!--Review 3-->
    <div class="review3">
      <p1>"Amazing range of clothing options, with endless opportunities. Looking forward to those shoes that I
        ordered"- Tyrone Jordan</p1>
    </div>
  </div>

  <!--Title 3 -Where you can find us!-->
  <div class="w3-container w3-padding-64 w3-center  w3-light-grey w3-xlarge">
    <h2>Where you can find us!</h2>
  </div>

  <!--Google maps-->
  <!--Reference for code used: https://www.google.com/maps/place/Aston+University+Main+Building/@52.4837513,-1.89554,16.13z/data=!3m1!5s0x4870bc9baaa06f5b:0x171e106cb1051ba5!4m5!3m4!1s0x4870bd2e9cf474ef:0xb48a787296dbcd89!8m2!3d52.4866299!4d-1.889857-->
  <!--Once i had my location that i wanted, i then clicked onto Share/Embed a map , this gave me the code which i pasted below-->
  <div class="maps">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2429.5860754138334!2d-1.8920456839200972!3d52.48662987980791!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bd2e9cf474ef%3A0xb48a787296dbcd89!2sAston%20University%20Main%20Building!5e0!3m2!1sen!2suk!4v1669167102012!5m2!1sen!2suk" width="1500" height="300" style="border:0; margin-left: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div><br>
  <div>
    <!-- site wide footer -->
    <?php include 'footer.php'; ?>

</body>

</html>