<!DOCTYPE html>
<html lang="en">

<head>
    <title>Products |Find your product here</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/products.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <?php
    require_once("connectDB.php");
    if (isset($_GET['search'])) {
        $searchValue = $_GET['search'];
        $rows = $db->query("SELECT * FROM products WHERE MATCH(prodName) AGAINST('$searchValue')");
    }
    ?>
</head>

<!-- header for the page-->
<header>
    <!-- Navbar class used to locat the navbar in the landing page -->
    <nav class="navbar navbar-default">
        <a class="navbar-brand" href="index.php"></a>
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="index.php"><img src="Images/Logo.png" alt="logo" style="width: 80px;"></a>

                <!-- Constractor of the lnding page and other pages linked -->
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php?page=home"><i class="fa fa-fw fa-home"></i> Home</a></li>
                <li class="active"><a href="products.php?page=product">Products</a></li>
                <li><a href="login.php?page=account">My Account</a></li>
                <li><a href="contactUs.php?page=contact">Contact Us</a></li>
                <li><a href="aboutUs.php?page=about">About Us</a></li>
                <li><a href="cart.php?page=cart">Checkout</a></li>
            </ul>
            <form class="navbar-form navbar-right" action="/productSearch.php">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search" />
                    <input type="submit" class="btn btn-primary" value="Search" />
                </div>
            </form>
        </div>
    </nav>
</header>

<body>
    <!-- shows products-->
    <section id="page-section">
        <div class="container">
            <div class="row">
                <?php
                $num_rows = $rows->fetchColumn();
                if ($num_rows <= 0) {
                    echo "<h1><center>No products found</h1></center>";
                    echo "<br>";
                }
                foreach ($rows as $row) {
                ?>
                    <br>
                    <a href="productDisplay.php?id=<?php echo $row['prodID'] ?>&page=product">
                        <div class="col-sm-3 col-md-6 col-lg-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <?php echo '<img width="100" height="100" src="data:image/jpeg;base64,' . base64_encode($row['prodImage']) . '"/>'; ?>
                                    <h5 class="card-title"><b><?php echo $row['prodName']; ?></b></h5>
                                    <p class="tags">Price: £<?php echo $row['prodPrice']; ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

</body>
<br>
<!-- footer for the page -->
<?php include('footer.php'); ?>

</html>