<?php

$db_host = 'localhost';
$db_name = 'MW4U';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
} catch (PDOException $ex) {
    echo ("Failed to connect to the database.<br>");
    echo ($ex->getMessage());
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Checkout Cart</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="language" content="English, EN">
    <meta name="description" content="MW4U basket screen">
    <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
    <link rel="icon" type="image/x-icon" href="./assets/logos/favicon.ico">
    <script src="Storage.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/checkout.css">
</head>


<header>
    <?php include 'header.php'; ?>
</header>

<body>
    <div class=”cartContainer”></div>
    <div class=”tableHeader”>
        <h3 class=”tableHeading”>Shopping Cart</h3>
        <h5 class=”tableAction”>Remove all</h5>
    </div>
    <!--START LOOP HERE FOR MULTI ITEMS-->
    <div class=”cartItems”>
        <div class=”tableImageBox”>
            <img src=<!--Link to data base and add imge of item here--> style={{ height=”120px” }} />
        </div>

        <div class=”itemAbout”>
            <h1 class=”itemTitle”>
                <!--Add descr of item-->
            </h1>
            <h3 class=”itemSize”>
                <!--Add size of item-->
            </h3>

        </div>

    </div>
    <div class=”itemCounter”>
        <div class=”btn”>+</div>
        <div class=”count”>
            <!--add java to change count on press-->
        </div>
        <div class=”btn”>-</div>
    </div>

    <div class=”itemPrices”>
        <div class=”itemCost”>
            <!--make value eque item value * count-->
        </div>
        <div class=”remove”><u>Remove</u></div>
    </div>
    <!--LOOP SECTION ABOVE TO CREATE MULTIPLE ITEMS-->

    <hr>
    <div class=”checkout”>
        <div class=”total”>
            <div>

                <div class=”subtotal”>Sub-Total</div>
                <div class=”itemTotal”>
                    <!--total number of items-->
                </div>

            </div>
            <div class=”totalAmount”>
                <!--total all inputted values-->
            </div>
        </div>
        <button class=”checkoutButton”>Checkout</button>
    </div>


<?php include 'footer.php'; ?>

</body>

</html>