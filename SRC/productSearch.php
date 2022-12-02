<?php
//Database connection file
require_once("connectDB.php");
if (isset($_GET['search'])) {
    //Get search value from URL
    $searchValue = $_GET['search'];
    //Database query using the search value
    $rows = $db->query("SELECT * FROM products WHERE MATCH(prodName) AGAINST('$searchValue')");
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Page title with other essential links to support CSS and Bootstrap elemts used in the website -->
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
</head>

<!-- header for the page-->
<header>
    <!-- Navbar class used to locat the navbar in the landing page -->
    <?php include 'header.php'; ?>
</header>

<body>
    <!-- shows products-->
    <section id="page-section">
        <div class="container">
            <div class="row">
                <?php
                $num_rows = $rows->fetchColumn();
                //If no products are found then display message 
                if ($num_rows <= 0) {
                    echo "<h1><center>No products found</h1></center>";
                    echo "<br>";
                }
                //Otherwise iterate through all products to display
                foreach ($rows as $row) {
                ?>
                    <br>
                    <!-- link to product display page -->
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
    <!-- footer for the page -->
    <footer><?php include('footer.php'); ?></footer>
</body>
<br>


</html>