<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
//Database connection file
require_once("connectDB.php");
?>

<!DOCTYPE html>
<html lang="en">

<!-- Page title with other essential links to support CSS and Bootstrap elements used in the website -->
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- styling for the site that centres the tables -->
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- navbar for the user dashboard site -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="adminDashboard.php">Customer Dashboard</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
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
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="logout.php">
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- orders table -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Orders
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order Date</th>
                            <th>Total Price</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <?php
                    //Database connection file
                    include("dashboardConfig.php");
                    //Get user id from the url
                    $id = $_GET["id"];
                    $sql = "SELECT * FROM orders WHERE customerID=$id";
                    if (mysqli_query($conn, $sql)) {
                        echo "";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                    $count = 1;
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output order(s) data
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tbody>
                                <tr>
                                    <th>
                                        <?php echo $row['orderID']; ?>
                                    </th>
                                    <td>
                                        <?php echo $row['orderDate']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['totalPrice']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['orderStatus']; ?>
                                    </td>
                                </tr>
                            </tbody>
                    <?php
                            $count++;
                        }
                    } else {
                        echo '0 results';
                    }
                    ?>
                </table>
            </div>
        </div>
</body>

</html>