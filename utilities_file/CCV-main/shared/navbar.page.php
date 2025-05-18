<nav class="navbar fixed-top">
    <!-- bg-body-tertiary -->
    <div class="container-fluid m-1">
        <a class="navbar-brand ml-10" href="#"><img src="../assets/img/logo/yt_final1.png" alt="CCV Logo" width="160"></a>

        <!-- Navbar links for larger screens -->
        <div class="d-none d-md-flex">
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="#aboutus">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="#team">Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./signup.php">Sign Up</a>
                </li>
            </ul>
        </div>

        <!-- Hamburger menu for smaller screens -->
        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Offcanvas menu for smaller screens -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><a class="navbar-brand" href="#"><img src="../assets/img/logo/ElevateHer_Logo_Bold.png" alt="Elevate Her Logo" width="160"></a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fuchsia" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fuchsia" href="#aboutus">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fuchsia" href="./login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fuchsia" href="./signup.php">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>