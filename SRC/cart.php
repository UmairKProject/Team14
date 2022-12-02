<?php
//Initialize the session
session_start();
//Database connection files
require_once("dbcontroller.php");
require_once("connectDB.php");
require_once("config.php");
$db_handle = new DBController();
//Only entered if an action is activated
if (!empty($_GET["action"])) {
	//Switch case loop
	switch ($_GET["action"]) {
			//Add a product to the card
		case "add":
			if (!empty($_POST["quantity"])) {
				//Get the relevant product data using the product code
				$productByCode = $db_handle->runQuery("SELECT * FROM products WHERE prodCode='" . $_GET["code"] . "'");
				//Create an array for the item
				$itemArray = array($productByCode[0]["prodCode"] => array('name' => $productByCode[0]["prodName"], 'id' => $productByCode[0]["prodID"], 'code' => $productByCode[0]["prodCode"], 'size' => $_POST["size"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["prodPrice"], 'image' => $productByCode[0]["prodImage"]));
				//Entered in the case of another product needing to be added
				if (!empty($_SESSION["cart_item"])) {
					//If product is already in the cart, so increase the quantity
					if (in_array($productByCode[0]["prodCode"], array_keys($_SESSION["cart_item"]))) {
						foreach ($_SESSION["cart_item"] as $k => $v) {
							if ($productByCode[0]["prodCode"] == $k) {
								if (empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
						}
					} else {
						//General add to the cart
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
					}
				} else {
					//If first product to be added
					$_SESSION["cart_item"] = $itemArray;
				}
			}
			//leave the switch case loop
			break;
			//Remove a product from the cart
		case "remove":
			if (!empty($_SESSION["cart_item"])) {
				//Iterate throguh the array and remove relevant product
				foreach ($_SESSION["cart_item"] as $k => $v) {
					if ($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if (empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
				}
			}
			//leave the switch case loop
			break;
			//Empty the entire cart
		case "empty":
			//unset all the values in the cart
			unset($_SESSION["cart_item"]);
			//leave the switch case loop
			break;
			//Checkout all items from the cart and add the order to the database
		case "checkout":
			//assign variables with relevant data
			$date = date('Y-m-d');
			$order_Status = "Processing";
			$totalPrice = $_GET['price'];
			$username = $_POST['username'];
			//Database query that fetches the customerID depending on the username
			$result = mysqli_query($link, "SELECT customerID FROM customers WHERE customerUsername='$username'");
			$userID = $result->fetch_array()[0];

			if (!empty($username)) {
				//Database insertion
				$sql = "INSERT INTO orders (orderDate, totalPrice, customerID, orderStatus) VALUES (?,?,?,?)";
				$stmt = $db->prepare($sql);
				$stmt->execute([$date, $totalPrice, $userID, $order_Status]);
				//Unset all variables from the database
				unset($_SESSION["cart_item"]);
				unset($_POST['username']);
				unset($_GET['price']);
			} else {
				//Message error if no username is provided
				echo '<script type="text/javascript">
					alert("Enter a username!");
					</script>';
			}
			//leave the switch case loop
			break;
	}
}
?>
<html>

<head>
	<title>MW4U | Look smart with MW4U products</title>
	<link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="css/cartStyles.css" type="text/css" rel="stylesheet" />
</head>

<body>
	<!-- header for all pages -->
	<header><?php include 'header.php'; ?></header>
	<!-- shopping cart -->
	<div id="shopping-cart">
		<div class="txt-heading">Shopping Cart</div>
		<!-- button that empties cart -->
		<a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a>
		<?php
		if (isset($_SESSION["cart_item"])) {
			//Initialize total quantity and price variables
			$total_quantity = 0;
			$total_price = 0;
		?>
			<!-- cart table -->
			<table class="tbl-cart" cellpadding="10" cellspacing="1">
				<tbody>
					<tr>
						<th style="text-align:left;">Name</th>
						<th style="text-align:left;">Code</th>
						<th style="text-align:left;">Size</th>
						<th style="text-align:right;" width="5%">Quantity</th>
						<th style="text-align:right;" width="10%">Unit Price</th>
						<th style="text-align:right;" width="10%">Price</th>
						<th style="text-align:center;" width="5%">Remove</th>
					</tr>
					<?php
					//Iterate through each item and fill the table
					foreach ($_SESSION["cart_item"] as $item) {
						$item_price = $item["quantity"] * $item["price"];
					?>
						<tr>
							<td> <?php echo '<img class="cart-item-image" width="150" height="150" src="data:image/jpeg;base64,' . base64_encode($item["image"]) . '"/>'; ?><?php echo $item["name"]; ?></td>
							<td><?php echo $item["code"]; ?></td>
							<td><?php echo $item['size']; ?></td>
							<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
							<td style="text-align:right;"><?php echo "£ " . $item["price"]; ?></td>
							<td style="text-align:right;"><?php echo "£ " . number_format($item_price, 2); ?></td>
							<td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="Images/icon-delete.png" alt="Remove Item" /></a></td>
						</tr>
					<?php
						//Add to the total quantity and price variables
						$total_quantity += $item["quantity"];
						$total_price += ($item["price"] * $item["quantity"]);
					}
					?>
					<tr>
						<!-- display total quantity and price -->
						<td colspan="2" align="right">Total:</td>
						<td align="right"><?php echo $total_quantity; ?></td>
						<td align="right" colspan="2"><strong><?php echo "£ " . number_format($total_price, 2); ?></strong></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		<?php
		} else {
		?>
			<!-- displayed if cart is empty -->
			<div class="no-records">Your Cart is Empty</div>
		<?php
		}
		?>
		<!-- form used to checkout and add data to the database -->
		<form method="post" action="cart.php?action=checkout&price=<?php echo $total_price; ?>">
			<label>Enter your username:</label>
			<input type="text" name="username" />
			<input id="btnCheckout" type="submit" value="Checkout" class="btnCheckoutAction" />
		</form>
	</div>

</body>
<br>
<br>
<br>
<br>
<br>
<br>

<!--footer for the webpage -->
<footer><?php include 'footer.php'; ?></footer>

</html>