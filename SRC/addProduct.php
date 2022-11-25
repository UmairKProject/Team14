<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: adminLogin.php");
    exit;
}

// Include config file
require_once "config.php";
require_once "connectdb.php";

// Define variables and initialize with empty values
$productName = $productCategory = $productPrice = $productInformation = $productImage = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productPrice = $_POST['productPrice'];
    $productInformation = $_POST['productInfo'];
    $productImage = $_POST['productImage'];
    switch ($productCategory) {
        case 'Shoes':
            $productCategory = '1 - Shoes';
            break;
        case 'T-Shirt':
            $productCategory = '2 - T-Shirt';
            break;
        case 'Jeans':
            $productCategory = '3 - Jeans';
            break;
        case 'Caps':
            $productCategory = '4 - Caps';
            break;
        case 'Hoodies':
            $productCategory = '5 - Hoodies';
            break;
        case 'Shirts':
            $productCategory = '6 - Shirts';
            break;
        default:
    }

    $sql = "INSERT INTO products (prodName, prodPrice, prodInfo, prodImage, categoryID)
    VALUES (?,?,?,?,?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$productName, $productPrice, $productInformation, $productImage, $productCategory]);
}

//Close connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="./assets/logos/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="adminDashboard.php">Admin Dashboard</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                    <a class="nav-link" href="addProduct.php">
                        <i class="fa fa-check-square"></i>
                        <span class="nav-link-text">Create Product</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                    <a class="nav-link" href="register.php">
                        <i class="fa fas fa-user"></i>
                        <span class="nav-link-text">Register Users</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search for...">
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="AdminLogout.php">
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>

    <form method="post">
        <div class="form-group">
            <label>Product Name:</label>
            <input type="text" name="productName" value="<?php echo $productName; ?>">
        </div>
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
        <div class="form-group">
            <label>Product Price:</label>
            <input type="text" name="productPrice" placeholder="ex: £10" value="<?php echo $productPrice; ?>">
        </div>
        <div class="form-group">
            <label>Product Info:</label>
            <input type="text" name="productInfo" value="<?php echo $productInformation; ?>">
        </div>
        <div class="form-group">
            <label>Product Image:</label>
            <input type="file" name="productImage" value="<?php echo $productImage; ?>">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="AddProduct">
        </div>
    </form>

</body>

</html>