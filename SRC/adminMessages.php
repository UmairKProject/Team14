<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
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
    <link rel="icon" type="image/x-icon" href="/Images/Logo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styling to algin table -->
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- navbar used across all admin pages -->
    <header>
    <?php include 'adminDashboardHeader.php'; ?>
    </header>

    <br>
    <!-- welcome message to user -->
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    
    <!-- table to display all messages -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Messages
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Contact ID</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <?php
                    //Database connection files
                    include("dashboardConfig.php");
                    //Query the database
                    $sql = 'SELECT * from contactUs';
                    //Error checking for the query
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
                                        <?php echo $row['contactID']; ?>
                                    </th>
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['subject']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['message']; ?>
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