<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<body>
    <div class= "title">
        <h1>Login</h1>
        </div>
        <div class ="login">
            <form action ="" method ="POST">
                <label>Email Address:</label><br><input type="email" name="email" placeholder="Email Address" required><br>
                <label>Password:</label><br><input type="password" name="password" placeholder="Password" required><br><br>
                <div class = "sub">
                <button type = "submit" name = "login">Login</button>
            </div>
            </form>
        </div>
        <div class ="g-recaptcha" data-sitekey ="6LcONR8jAAAAAN9354cl4TwWxc5B9icmmGhGH0ir"></div>
        <div class ="info">
            <p>Not a User?</p>
            <a href="" >Register now!</a>
        </div>

</script>
</body>
</html>