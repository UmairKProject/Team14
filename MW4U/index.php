<!DOCTYPE html>
<html>

<head>
    <title>MW4U |Men’s Wear 4 U</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <?php
    require_once("connectdb.php");
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
    $rows = $db->query("SELECT * FROM products");
    ?>
</head>
<header>
    <h1> Welcome to your Men's Wear Shop</h1>
</header>

<body>
    <section class="s1">
        <div class="nav">
            <a class="home" href="index.php">Home.</a>
            <div class="nav-right">
                <a id="contactButton" href="#" onclick="contactFunction(); return false;">Contact</a>
            </div>
        </div>
        <div class="productList">
            <?php
            foreach ($rows as $row) {
            ?>
                <br>
                <div class="productContainer">
                    <br>
                    NAME: <?= $row['prodName'] ?>
                    <br>
                    DESCRIPTION: <?= $row['prodPrice'] ?>
                    <br>
                    PRICE: <?= $row['prodInfo'] ?>
                    <br>
                    <?php echo '<img width="400" height="300" src="data:image/jpeg;base64,' . base64_encode($row['prodImage']) . '"/>'; ?>
            <?php
            }
            ?>
                </div>
        </div>
    </section>

    <br>
</body>
<footer class="w3-container w3-padding-64 w3-center w3-light-grey w3-xlarge">
    <p>Follow US on social media</p>
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
    <p class="w3-smal"></p> 2021-2022</p>
    <p class="w3-medium">Designed By: <a href="Index.html" target="_blank">Team 14 _ Team Project Module</a></p>
</footer>

</html>