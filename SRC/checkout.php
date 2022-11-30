<?php

include 'config.php';

session_start();

$customerID = $_SESSION['customerID'];

// if(!isset($user_id)){
//    header('location:login.php');
// }

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($link, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');
   $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
   $size = mysqli_real_escape_string($conn, $_POST['size']);


   $basketTotal = 0;
   $basketProducts[] = '';

   $basketQuery = mysqli_query($link, "SELECT * FROM `basket` WHERE customerID = '$customerID'") or die('query failed');
   if(mysqli_num_rows($basketQuery) > 0){
      while($basketItem = mysqli_fetch_assoc($basketQuery)){
         $basketProducts[] = $basketItem['name'].' ('.$basketItem['quantity'].') ';
         $sub_total = ($basketItem['price'] * $basketItem['quantity']);
         $basketTotal += $sub_total;
      }
   }

   $totalProducts = implode(', ',$basketProducts);

   $orderQuery = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name'  AND email = '$email' AND method = '$method' AND address = '$address' AND totalProducts = '$totalProducts' AND totalPrice = '$basketTotal'") or die('query failed');

   if($basketTotal == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(customerID, name, email, method, address, totalProducts, size, quantity, total_price, placed_on) VALUES('$customerID', '$name', '$email', '$method', '$address', '$totalProducts', '$size', '$quantity', '$basketTotal', '$placed_on')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `basket` WHERE user_id = '$customerID'") or die('query failed');
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/cart.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">home</a> / checkout </p>
</div>

<section class="display-order">

   <?php  
      $grandTotal = 0;
      $selectBasket = mysqli_query($conn, "SELECT * FROM `basket` WHERE cutomerID = '$customerID'") or die('query failed');
      if(mysqli_num_rows($selectBasket) > 0){
         while($fetchBasket = mysqli_fetch_assoc($selectBasket)){
            $totalPrice = ($fetchBasket['price'] * $fetchBasket['quantity']);
            $grandTotal += $totalPrice;
            
   ?>
   <p> <?php echo $fetchBasket['name']; ?> <span>(<?php echo '$'.$fetchBasket['price'].'/-'.' x '. $fetchBasket['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span>$<?php echo $grandTotal; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="credit card">credit card</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>address line 02 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. Birmingham">
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" required placeholder="e.g. west midlands">
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" required placeholder="e.g. England">
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
         <div class="inputBox">
            <span>size</span>
            <input type="text" min="0" name="size" required placeholder="">
         </div>
         <div class="inputBox">
            <span>quantity</span>
            <input type="int" min="1" name="quantity" required placeholder="">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>
   
</section>



<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>