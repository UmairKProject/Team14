<!-- general navbar used across all admin pages -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <!-- link to dashboard page -->
    <a class="navbar-brand" href="adminDashboard.php">Admin Dashboard</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <!-- link to the add product page -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                <a class="nav-link" href="addProduct.php">
                    <i class="fa fa-check-square"></i>
                    <span class="nav-link-text">Create Product</span>
                </a>
            </li>
            <!-- link to the admin messages page (recieved from contactUs page) -->
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                <a class="nav-link" href="adminMessages.php">
                    <i class="fa fa-check-square"></i>
                    <span class="nav-link-text">Messages</span>
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
            <!-- link to the logout page -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="adminLogout.php">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>

        </ul>
    </div>
</nav>