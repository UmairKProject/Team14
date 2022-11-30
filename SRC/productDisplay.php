<!DOCTYPE html>
<html>

<head>
    <title>MW4U |Men’s Wear 4 U</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./assets/logos/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <?php
    require_once("connectDB.php");
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
    $id = $_GET["id"];
    $rows = $db->query("SELECT * FROM products WHERE prodID=$id");
    ?>
</head>

<?php include('header.php') ?>

<body>

    <div class="singleProductContainer">
    <?php
    foreach ($rows as $row) {
    ?>
        <div class="row">
            <div class="col-md-4">
                <?php echo '<img width="400" height="300" src="data:image/jpeg;base64,' . base64_encode($row['prodImage']) . '"/>'; ?>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <h1 class="productImportant productName"><?= $row['prodName'] ?></h1>
                </div>
                <br>
                <div class="row">
                    <?= $row['prodInfoShort'] ?>
                </div>
                <br>
                <div class="row" align="center">
                    <h4 class="productDescription">Size:
                    <select class="custom-select" style="width:50px" ></h4>
                        <option value="0">XS</option>
                        <option value="1">S</option>
                        <option value="2">M</option>
                        <option value="3">L</option>
                        <option value="4">XL</option>
                    </select>
                </div>
                <br>
                <div class="row">
                    <h5 class="productImportant">Price:<span class="priceHighlight">£<?= $row['prodPrice'] ?></span></h5>
                </div>
                <div class="row mt-3">
                    <div class="productImportant">
                        <a href="basket.php?"><button class="btn btn-primary btn-lg"> <i class="fa fa-shopping-cart-me-2"></i>Add to Cart</button></a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <h4 class="productDescription">Product Description: </h4>
                </div>
                <div class="row">
                    <?= $row['prodInfo'] ?>
                </div>
            </div>

        </div>

    <?php 
        }
    ?>
    </div>
        <br>
</body>

<?php include('footer.php'); ?>

</html>
