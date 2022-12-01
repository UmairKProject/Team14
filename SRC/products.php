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
  <link rel="stylesheet" type="text/css" href="css/products.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- 
    <?php
    require_once("connectDB.php");
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
<!-- navbar for this page -->
<?php include('header.php'); ?>

<body>
  <!-- shows products-->
  <section id="page-section">
    <div class="container">
      <div class="row">
        <?php
        foreach ($rows as $row) {
        ?>
          <br>
          <a href="productDisplay.php?id=<?php echo $row['prodID'] ?>">
            <div class="col-sm-3 col-md-6 col-lg-4">
              <div class="card">
                <div class="card-body text-center">
                  <?php echo '<img width="100" height="100" src="data:image/jpeg;base64,' . base64_encode($row['prodImage']) . '"/>'; ?>
                  <h5 class="card-title"><b><?php echo $row['prodName']; ?></b></h5>
                  <p class="tags">Price: £<?php echo $row['prodPrice']; ?></p>
                  <p class="card-text small"><?php echo $row['prodInfo']; ?></p>
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
<!-- page footer-->
<?php include 'footer.php'; ?>

</html>