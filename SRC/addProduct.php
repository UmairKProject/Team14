<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: adminLogin.php");
    exit;
}

// Include database connection files
require_once "config.php";
require_once "connectDB.php";

// Define variables and initialize with empty values
$productName = $productCategory = $productPrice = $productInformation = $productImage = $productImageUpload = $productCode = "";

// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Assign values to variables
    $productName = $_POST['productName'];
    $productCode = $_POST['productCode'];
    $productCategory = $_POST['productCategory'];
    $productPrice = $_POST['productPrice'];
    $productInformation = $_POST['productInfo'];
    $productImage = $_FILES['productImage'];
    //Get actual image data from the uploaded to file
    $productImageUpload = file_get_contents($_FILES['productImage']['tmp_name']);
    //Loop switch sequence to assign correct values to the productCategory
    switch ($productCategory) {
        case 'Shoes':
            $productCategory = '1';
            break;
        case 'T-Shirt':
            $productCategory = '2';
            break;
        case 'Jeans':
            $productCategory = '3';
            break;
        case 'Caps':
            $productCategory = '4';
            break;
        case 'Hoodies':
            $productCategory = '5';
            break;
        case 'Shirts':
            $productCategory = '6';
            break;
        default:
    }
    //Insertion into the database
    $sql = "INSERT INTO products (prodName, prodPrice, prodInfo, prodImage, categoryID, prodCode)
    VALUES (?,?,?,?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$productName, $productPrice, $productInformation, $productImageUpload, $productCategory, $productCode]);
    //When product added we return to the dashboard
    header("location: adminDashboard.php");
}

//Close connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styling for the body -->
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>
<header>
    <!-- Navbar used acrros all admin sites -->
    <?php include 'adminDashboardHeader.php' ?>
</header>

<body>

    <br>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <!-- form used to add a product to the database -->
    <form method="post" enctype="multipart/form-data">
        <!-- product name -->
        <div class="form-group">
            <label>Product Name:</label>
            <input type="text" name="productName" value="<?php echo $productName; ?>">
        </div>
        <!-- product code -->
        <div class="form-group">
            <label>Product Code:</label>
            <input type="text" name="productCode" value="<?php echo $productCode; ?>">
        </div>
        <!-- product category (selection) -->
        <div class="form-group">
            <label>Product Category:</label>
            <select name="productCategory" value="<?php echo $productCategory; ?>">
                <option value="Shoes">Shoes</option>
                <option value="T-Shirt">T-Shirt</option>
                <option value="Jeans">Jeans</option>
                <option value="Caps">Caps</option>
                <option value="Hoodies">Hoodies</option>
                <option value="Shirts">Shirts</option>
            </select>
        </div>
        <!-- product price -->
        <div class="form-group">
            <label>Product Price(£):</label>
            <input type="text" name="productPrice" placeholder="ex: 10" value="<?php echo $productPrice; ?>">
        </div>
        <!-- product information -->
        <div class="form-group">
            <label>Product Info:</label>
            <input type="text" name="productInfo" value="<?php echo $productInformation; ?>">
        </div>
        <!-- product image (allows user to insert image file) -->
        <div class="form-group">
            <label>Product Image:</label>
            <input type="file" name="productImage" value="<?php echo $productImage; ?>">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="AddProduct" />
        </div>
    </form>

</body>

</html>