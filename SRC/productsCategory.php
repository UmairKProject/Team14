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
  if (isset($_GET['id'])) {
    $id = $_GET["id"];
    $rows = $db->query("SELECT * FROM products WHERE categoryID=$id");
  } else {
    echo "Not a category";
  }

  ?>
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

    *,
    *:before,
    *:after {
      box-sizing: inherit;
    }

    .column {
      float: left;
      width: 33.3%;
      margin-bottom: 16px;
      padding: 0 8px;
    }

    @media screen and (max-width: 650px) {
      .column {
        width: 100%;
        display: block;
      }
    }

    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .container {
      padding: 0 16px;
    }

    .container::after,
    .row::after {
      content: "";
      clear: both;
      display: table;
    }

    .title {
      color: grey;
    }

    .button {
      border: none;
      outline: 0;
      display: inline-block;
      padding: 8px;
      color: white;
      background-color: rgb(131, 131, 131);
      text-align: center;
      cursor: pointer;
      width: 20%;
      border-radius: 20px;
      align-self: center;
    }

    * {
      box-sizing: border-box;
    }

    .img-comp-container {
      position: relative;
      height: 200px;
      /*should be the same height as the images*/
    }

    .img-comp-img {
      position: absolute;
      width: auto;
      height: auto;
      overflow: hidden;
    }

    .img-comp-img img {
      display: block;
      vertical-align: middle;
    }

    .img-comp-slider {
      position: absolute;
      z-index: 9;
      cursor: ew-resize;
      /*set the appearance of the slider:*/
      width: 40px;
      height: 40px;
      background-color: #2196F3;
      opacity: 0.7;
      border-radius: 50%;
    }
  </style>

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