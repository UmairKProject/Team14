<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/scrolltopcontrol.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/Style.css">
    <title>Register Page</title>
</head>

<body>
    <nav class="navbar navbar-default">
        <a class="navbar-brand" href="Index.html">
            <img src="Images/Logo.png" alt="logo" style="width:120px;">
        </a>
        <div class="container-fluid">
            <div class="navbar-header">

                <ul class="nav navbar-nav">
                    <li><a href="Index.html"><i class="fa fa-fw fa-home"></i> Home</a></li>
                    <li><a href="Products.html">Products</a></li>
                    <li><a href="New Arrivals.html">New Arrivals</a></li>
                    <li><a href="Gallery.html">Gallery</a></li>
                    <li class="active"><a href="My Account.html">My Account</a></li>
                    <li><a href="Contact Us.html">Contact Us</a></li>
                    <li><a href="About Us.html">About Us</a></li>
                </ul>
                <form class="navbar-form navbar-left" action="/action_page.php">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </form>
            </div>
    </nav>
    <div class="title">
        <h1>Register</h1>
    </div>
    <div id="register">
        <div class="textinfo">
            <h3>Create a Free Account now</h3>
            <form action="" method="POST" onsubmit="return validate();">
                <label>Name:<span>*</span></label><br>
                <input type="text" id="name" name="name" placeholder="Full Name" required><br><br>
                <label>Email:<span>*</span></label><br>
                <input type="email" id="email" name="email" placeholder="Email Address" required><br><br>
                <label>Password:<span>*</span></label><br>
                <input type="password" id="password" name="password" placeholder="Password" required><br><br>
                <label>Confirm Password:<span>*</span></label><br>
                <input type="password" id="confirm-password" name="password" placeholder="Confirm Password" required><br>
        </div>
        <div class="h-captcha" data-sitekey="667aee51-3796-4f0c-a600-8c4f4754745a" data-callback="verifyCaptcha" required></div>
        <div id="bot-verify"></div>

        <div class="buttons">
            <button class="register-buttonv2">Register</button><br>
            <p3>Already a User?</p3><br>
            <button onclick="location.href='login.php'" class="login-buttonv2" type="button">Login</button>
        </div>
        </form>

        <script src='https://www.hCaptcha.com/1/api.js'></script>
        <script>
            var sec = '';

            function validate() {

                if (sec.length == 0) {
                    document.getElementById('bot-verify');
                    alert("Please perform the capachia!")
                    return false;
                }
                alert("Success!")
                return true;
            }

            function verifyCaptcha(token) {
                sec = token;
                document.getElementById('bot-verify');
            }
        </script>

    </div>
    </script>
    <footer class="w3-container w3-padding-64 w3-center w3-light-grey w3-xlarge">
        <p>Follow us on social media</p>
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
        <p class="w3-smal"></p> 2022-2023</p>
        <p class="w3-medium">Designed By: <a href="Index.html" target="_blank">Team Number 14</a></p>
    </footer>
</body>

</html>