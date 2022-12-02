<?php
//Database connection file
require_once("connectDB.php");
//Query required to dispaly all products
$rows = $db->query("SELECT * FROM products ORDER BY categoryID;");
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
  <!-- styling for the site -->
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
</head>



<body>
  <!-- navbar for this page -->
  <header><?php include('header.php'); ?></header>
  <!-- shows products-->
  <section id="page-section">
    <div class="container">
      <div class="row">
        <?php
        //Iterate through each product row
        foreach ($rows as $row) {
        ?>
          <br>
          <!-- link that lets you display more information for a product -->
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


  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>



  <!--This Java Script code would allow the user to push a button and automaticly scroll all the way up to the top of the page-->
  <script type="text/javascript" src="js/scrolltopcontrol.js">
    /***********************************************
     * Scroll To Top Control script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
     * Please keep this notice intact
     * Visit Project Page at http://www.dynamicdrive.com for full source code
     ***********************************************/
  </script>
  <!-- page footer-->
  <footer><?php include 'footer.php'; ?></footer>
</body>
<br>


</html>