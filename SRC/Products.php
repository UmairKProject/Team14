<!DOCTYPE html>
<html lang="en">

    <head>
    <title>Products |Find your product here</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   
<!-- 
    <?php
    require_once("connectdb.php");
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
    if (isset($_GET['id'])) {
        $id = $_GET["id"];
        $rows = $db->query("SELECT * FROM products WHERE prodID=$id");
    } else {
        $rows = $db->query("SELECT * FROM products");
    }
    
    ?>
-->
    </head>
    <style>
        body {
          font-family: "Lato", sans-serif
        }
    
        .mySlides {
          display: none
        }
    
        html {
          box-sizing: border-box;
        }
        </style>
<!--
    <?php include('header.php'); ?>
-->
    <body>
        <!-- navbar for this page -->
        <nav class="navbar navbar-default">
            <a class="navbar-brand" href="Index.html">
              <img src="Images/Logo.png" alt="logo" style="width:70px;">
            </a>
            <div class="container-fluid">
              <div class="navbar-header">
          
              </div>
              <ul class="nav navbar-nav">
                <li><a href="Index.html"><i class="fa fa-fw fa-home"></i> Home</a></li>
                <li> <class="active"> <a href="Products.html">Products</a></li>
                <li><a href="New Arrivals.html">New Arrivals</a></li>
                <li><a href="Gallery.html">Gallery</a></li>
                <li><a href="My Account.html">My Account</a></li>
                <li><a href="Contact Us.html">Contact Us</a></li>
                <li><a href="About Us.html">About Us</a></li>
              </ul>
              <form class="navbar-form navbar-left" action="/action_page.php">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
              </form>
            </div>
          </nav>

            <br>
            <br>
        <div class="productList">

        <!--<?php
            foreach ($rows as $row) {
            ?>
            <br>
            <a href="productDisplay.php?id=<?php echo $row['prodID'] ?>">
                <div class="productContainer">
                <br>
                NAME: <?= $row['prodName'] ?>
                <br>
                PRICE: <?= $row['prodPrice'] ?>
                <br>
                DESCRIPTION: <?= $row['prodInfo'] ?>
                <br>
                <?php echo '<img width="400" height="300" src="data:image/jpeg;base64,' . base64_encode($row['prodImage']) . '"/>'; ?>
                <?php

            }
                ?> -->
                </div>
            </a>
        </div>
<!-- shows products-->
       
        <section id="page-section">
            <div class="container" >
                <div>&nbsp;</div>
					<div>&nbsp;</div>

					<div class="row">
						<div class="col-sm-3 col-md-6 col-lg-4">
							<div class="card">
								<div class="card-body text-center">
									<img src="Images/Sweatshirt.png" class="product-image">
									<h5 class="card-title"><b>Sweatshirt</b></h5>
									<p class="card-text small">100% Cotton Sweathshirt</p>
									<p class="tags">Price £250</p>
									<a href="" target="_blank" class="btn btn-success button-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
								</div>
							</div>
						</div>
                       
                        <br>
                        <br>

						<div class="col-sm-3 col-md-6 col-lg-4">
							<div class="card">
								<div class="card-body text-center">
									<img src="Images/Tshirt.png" class="product-image">
									<h5 class="card-title"><b>T-shirt</b></h5>
									<p class="card-text small">Mens Cotton T-shirt</p>
									<p class="tags">Price £100</p>
									<a href="#" class="btn btn-success button-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
								</div>
							</div>
						</div>
                        

						<div class="col-sm-3 col-md-6 col-lg-4">
							<div class="card">
								<div class="card-body text-center">
									<img src="Images/Trainers.png" class="product-image">
									<h5 class="card-title"><b>Trainers</b></h5>
									<p class="card-text small">Mens running trainers</p>
									<p class="tags">Price £120</p>
									<a href="#" class="btn btn-success button-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
								</div>
							</div>
						</div>
                        <br>
                        <br>
                        <br>
                        <br>
                        

                        <div class="col-sm-3 col-md-6 col-lg-4">
							<div class="card">
								<div class="card-body text-center">
									<img src="Images/Hoodie.png" class="product-image">
									<h5 class="card-title"><b>Hoodie</b></h5>
									<p class="card-text small">Mens Sports Hoodie</p>
									<p class="tags">Price £145</p>
									<a href="#" class="btn btn-success button-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
								</div>
							</div>
						</div>
                        <br>
                        <br>
                        <br>
                        <br>

                        <div class="col-sm-3 col-md-6 col-lg-4">
							<div class="card">
								<div class="card-body text-center">
									<img src="Images/Joggers.png" class="product-image">
									<h5 class="card-title"><b>Jogging Trousers</b></h5>
									<p class="card-text small">Mens running trousers</p>
									<p class="tags">Price £90</p>
									<a href="#" class="btn btn-success button-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
								</div>
							</div>
						</div>
                        <br>
                        <br>
                        

                        <div class="col-sm-3 col-md-6 col-lg-4">
							<div class="card">
								<div class="card-body text-center">
									<img src="Images/Jacket.png" class="product-image">
									<h5 class="card-title"><b>Jacket</b></h5>
									<p class="card-text small">Mens hooded jacket</p>
									<p class="tags">Price £160</p>
									<a href="#" class="btn btn-success button-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Add to cart</a>
								</div>
							</div>
						</div>
                        <br>
                        <br>
                        <br>
                        <br>

					</div>
					
            </div>
        </section> 


    </body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
<!-- page footer-->
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

</html>