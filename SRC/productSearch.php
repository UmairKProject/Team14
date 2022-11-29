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
    <?php
    require_once("connectDB.php");
    $db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password);
    if (isset($_GET['search'])) {
        $searchValue = $_GET['search'];
        $rows = $db->query("SELECT * FROM products WHERE MATCH(prodName) AGAINST('$searchValue')");
    } else {
        echo "Not a category";
    }

    ?>
</head>

<?php include('header.php'); ?>

<body>

    <br>
    <br>
    <div class="productList">
        <?php
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
                ?>
                </div>
            </a>
    </div>

    <?php include('footer.php'); ?>

</body>

</html>x