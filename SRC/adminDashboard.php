<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: adminLogin.php");
    exit;
}
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

        #userPref:hover {
            background-color: #e5e5e5;
        }
    </style>
</head>

<body>
    <?php include 'adminDashboardHeader.php'; ?>
    <br>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>

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
                            <th>Product ID</th>
                        </tr>
                    </thead>
                    <?php
                    include("dashboardConfig.php");
                    $sql = 'SELECT * from orders';
                    if (mysqli_query($conn, $sql)) {
                        echo "";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                    $count = 1;
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
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
                                        <?php echo $row['prodID']; ?>
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

        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Registered Users
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer Username</th>
                                <th>Customer Password</th>
                            </tr>
                        </thead>
                        <?php
                        include("dashboardConfig.php");
                        $sql = 'SELECT * from customers';
                        if (mysqli_query($conn, $sql)) {
                            echo "";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                        $count = 1;
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tbody>
                                    <?php $tempCustomerID = $row['customerID']; ?>
                                    <tr id="userPref" style="cursor: pointer; " onclick="window.location='userSettings.php?id=<?php echo $tempCustomerID ?>';">
                                        <th>
                                            <?php echo $tempCustomerID; ?>
                                        </th>
                                        <td>
                                            <?php echo $row['customerUsername']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['customerPassword']; ?>
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

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Current Listed Product Table
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name of Product</th>
                                    <th>Price of Product</th>
                                    <th>Product Category</th>
                                    <th>Product Details</th>
                                </tr>
                            </thead>
                            <?php
                            include("dashboardConfig.php");
                            $sql = 'SELECT * from products';
                            if (mysqli_query($conn, $sql)) {
                                echo "";
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                            $count = 1;
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tbody>
                                        <tr>
                                            <th>
                                                <?php echo $row['prodID']; ?>
                                            </th>
                                            <td>
                                                <?php echo $row['prodName']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['prodPrice']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['categoryID']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['prodInfo']; ?>
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