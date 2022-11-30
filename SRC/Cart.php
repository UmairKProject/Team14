<?php

include 'config.php';

session_start();

$customerID = $_SESSION['customerID'];

// if(!isset($customerID)){
//    header('location:login.php');
// }

if(isset($_POST['updateBasket'])){
   $basketID = $_POST['basketID'];
   $basketQuantity = $_POST['quantity'];
   mysqli_query($link, "UPDATE `basket` SET quantity = '$basketQuantity' WHERE basketID = '$basketID'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
   $deleteID = $_GET['delete'];
   mysqli_query($link, "DELETE FROM `basket` WHERE basketID = '$deleteID'") or die('query failed');
   header('location:cart.php');
}

if(isset($_GET['deleteAll'])){
   mysqli_query($link, "DELETE FROM `basket` WHERE customerID = '$customerID'") or die('query failed');
   header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="icon" type="image/x-icon" href="./assets/logos/favicon.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/cart.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <center><h1>shopping cart</h1></center>

</div>

<section class="shopping-cart">

   <center><h3 class="title">products added</h3></center>>

   <div class="box-container">
      <?php
         $grandTotal = 0;
         $selectBasket = mysqli_query($link, "SELECT * FROM `basket` WHERE customerID = '$customerID'") or die('query failed');
         if(mysqli_num_rows($selectBasket) > 0){
            while($fetchBasket = mysqli_fetch_assoc($selectBasket)){   
      ?>
      <div class="box">
         <a href="cart.php?delete=<?php echo $fetchBasket['basketID']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
         <img class="image" src="uploaded_img/<?php echo $fetchBasket['image']; ?>" alt="">
         <div class="name"><?php echo $fetchBasket['prodName']; ?></div>
         <div class="price">$<?php echo $fetchBasket['prodPrice']; ?>/-</div>
         <form action="" method="post">
            <input type="hidden" name="basketID" value="<?php echo $fetchBasket['baskteID']; ?>">
            <h3 id="size"><label for="size">size</label></h3>
            <input type="number" min="1" name="quantity" value="<?php echo $fetchBasket['quantity']; ?>">
            <input type="submit" name="updateBasket" value="Update" class="option-btn">
         </form>
         <div class="sub-total"> sub total : <span>$<?php echo $sub_total = ($fetchBaket['quantity'] * $fetchBasket['price']); ?>/-</span> </div>
      </div>
      <?php
      $grandTotal += $sub_total;
         }
      }else{
         echo '<p class="empty">your cart is empty</p>';
      }
      ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
   </div>

   <div class="cart-total">
      <p>grand total : <span>$<?php echo $grandTotal; ?>/-</span></p>
      <div class="flex">
         <a href="#" class="option-btn">Continue shopping</a>
         <a href="checkout.php" class="btn <?php echo ($grandTotal > 1)?'':'disabled'; ?>">Proceed to checkout</a>
      </div>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>