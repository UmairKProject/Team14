<?php
session_start();
require_once("dbcontroller.php");
require_once("connectDB.php");
$db_handle = new DBController();
if (!empty($_GET["action"])) {
	switch ($_GET["action"]) {
		case "add":
			if (!empty($_POST["quantity"])) {
				$productByCode = $db_handle->runQuery("SELECT * FROM products WHERE prodCode='" . $_GET["code"] . "'");
				$itemArray = array($productByCode[0]["prodCode"] => array('name' => $productByCode[0]["prodName"], 'id' => $productByCode[0]["prodID"], 'code' => $productByCode[0]["prodCode"], 'size' => $_POST["size"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["prodPrice"], 'image' => $productByCode[0]["prodImage"]));

				if (!empty($_SESSION["cart_item"])) {
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
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
			break;
		case "remove":
			if (!empty($_SESSION["cart_item"])) {
				foreach ($_SESSION["cart_item"] as $k => $v) {
					if ($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if (empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
				}
			}
			break;
		case "empty":
			unset($_SESSION["cart_item"]);
			break;
		case "checkout":
			$date = date('Y-m-d');
			$order_Status = "Processing";
			$totalPrice = $_GET['price'];
			$username = $_POST['username'];
			$stmt2 = $db->prepare("SELECT customerID FROM customers WHERE customerUsername='" . $username . "'");
			$userID = $stmt2->execute();
			if (!empty($username)) {
				$sql = "INSERT INTO orders (orderDate, totalPrice, customerID, orderStatus) VALUES (?,?,?,?)";
				$stmt = $db->prepare($sql);
				$stmt->execute([$date, $totalPrice, $userID,$order_Status]);
				unset($_SESSION["cart_item"]);
				unset($_POST['username']);
				unset($_GET['price']);
			} else {
				echo '<script type="text/javascript">
					alert("Enter a username!");
					</script>';
			}
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
	<?php include 'header.php'; ?>
</HEAD>

<body>
	<div id="shopping-cart">
		<div class="txt-heading">Shopping Cart</div>

		<a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a>
		<?php
		if (isset($_SESSION["cart_item"])) {
			$total_quantity = 0;
			$total_price = 0;
		?>
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
						$total_quantity += $item["quantity"];
						$total_price += ($item["price"] * $item["quantity"]);
					}
					?>

					<tr>
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
			<div class="no-records">Your Cart is Empty</div>
		<?php
		}
		?>
		<form method="post" action="cart.php?action=checkout&price=<?php echo $total_price; ?>">
			<label>Enter your username:</label>
			<input type="text" name="username" />
			<input id="btnCheckout" type="submit" value="Checkout" class="btnCheckoutAction" />
		</form>
	</div>

</body>

</html>