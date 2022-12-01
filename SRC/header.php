<header>
  <!-- Navbar class used to locat the navbar in the landing page -->
  <nav class="navbar navbar-default">
    <a class="navbar-brand" href="index.php"></a>
    <div class="container-fluid">
      <div class="navbar-header">
        <img src="Images/Logo.png" alt="logo" style="width: 80px;">

        <!-- Constractor of the lnding page and other pages linked -->
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="login.php">My Account</a></li>
        <li><a href="contactUs.php">Contact Us</a></li>
        <li><a href="aboutUs.php">About Us</a></li>
        <li><a href="cart.php">Checkout</a></li>
      </ul>
      <form class="navbar-form navbar-right" action="/productSearch.php">
        <div class="form-group">
          <input type="text" name="search" class="form-control" placeholder="Search" />
          <input type="submit" class="btn btn-primary" value="Search" />
        </div>
      </form>
    </div>
  </nav>
</header>