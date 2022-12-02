<?php
//Database connection files
require_once("connectDB.php");
require_once("config.php");

$db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
//Get a product's id from the url
$id = $_GET["id"];
//Get all info from a product using the relevant product id
$rows = $db->query("SELECT * FROM products WHERE prodID=$id");
?>

<!DOCTYPE html>
<html>

<!-- Page title with other essential links to support CSS and Bootstrap elemts used in the website -->

<head>
    <title>MW4U |Men’s Wear 4 U</title>
    <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/productDisplay.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>



<body>
    <!-- navbar for site -->
    <header><?php include('header.php') ?></header>
    <!-- container that displays the product -->
    <div class="singleProductContainer">
        <?php
        foreach ($rows as $row) {
        ?>
            <div class="row">
                <div class="col-md-4">
                    <!-- display product image with asssinged size -->
                    <?php echo '<img width="400" height="300" src="data:image/jpeg;base64,' . base64_encode($row['prodImage']) . '"/>'; ?>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <h1 class="productImportant productName"><?= $row['prodName'] ?></h1>
                    </div>
                    <br>
                    <div class="row">
                        <h5 class="productImportant">Price:<span class="priceHighlight">£<?= $row['prodPrice'] ?></span></h5>
                    </div>
                    <!-- form that allows a user to add a product to the card with relevant price,size and quantity -->
                    <form method="POST" action="cart.php?action=add&code=<?php echo $row["prodCode"]; ?>">
                        <div class=" row" align="center">
                            <h4 class="productDescription">Size:
                                <select class="custom-select" name="size" style="width:50px">
                            </h4>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            </select>
                        </div>
                        <div class="row mt-3">
                            <div class="productImportant">

                                <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                    </form>
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
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

<?php
        }
?>
</div>
<br>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>



<!--This Java Script code would allow the user to push a button and automaticly scroll all the way up to the top of the page-->
<script type="text/javascript" src="js/scrolltopcontrol.js">
    /***********************************************
     * Scroll To Top Control script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
     * Please keep this notice intact
     * Visit Project Page at http://www.dynamicdrive.com for full source code
     ***********************************************/
</script>
<!-- footer for the site -->
<footer><?php include('footer.php'); ?></footer>
</body>



</html>