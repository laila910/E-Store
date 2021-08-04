<body>
    <haader>
        <!-- Top bar Start -->
        <div class="top-bar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <i class="fa fa-envelope"></i> support@email.com
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-phone-alt"></i> +012-345-6789
                    </div>
                </div>
            </div>
        </div>
        <!-- Top bar End -->

        <!-- Nav Bar Start -->
        <div class="nav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto">
                            <a href="index.php" class="nav-item nav-link active">Home</a>
                            <a href="product-list.php" class="nav-item nav-link">Products</a>
                            <a href="product-detail.php" class="nav-item nav-link">Product Detail</a>
                            <a href="cart.php" class="nav-item nav-link">Cart</a>
                            <a href="checkout.php" class="nav-item nav-link">Checkout</a>
                            <a href="my-account.php" class="nav-item nav-link">
                                <?php if (isset($_SESSION['users'])) {

                                    echo 'My Account';
                                } ?></a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">More Pages</a>
                                <div class="dropdown-menu">
                                    <a href="wishlist.php" class="dropdown-item">Wishlist</a>
                                    <a href="login.php" class="dropdown-item"><?php if (!isset($_SESSION['users'])) { ?>Login & Register <?php } ?></a>
                                    <a href="contact.php" class="dropdown-item">Contact Us</a>
                                </div>
                            </div>
                        </div>
                        <div class="navbar-nav ml-auto">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php
                                                                                                    if (!isset($_SESSION['users'])) {

                                                                                                        echo "SignIn/Register";
                                                                                                    } else {
                                                                                                        echo $_SESSION['users']['firstName'];
                                                                                                    } ?>
                                    <div class="dropdown-menu">
                                        <?php if (!isset($_SESSION['users'])) { ?>
                                            <a href="login.php" class="dropdown-item">Login</a>
                                            <a href="icludes/signup.inc.php" class="dropdown-item">Register</a>
                                        <?php } else { ?>
                                            <a href="logout.php" class="dropdown-item">LogOut</a><?php } ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Nav Bar End -->
        <!-- Bottom Bar Start -->
        <div class="bottom-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="index.php">
                                <img src="img/logo.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form class="search" method="get" action="results.php" enctype="multipart/form-data">
                            <input type="text" name="user_query" placeholder="Search a product">
                            <button type="submit" name="search" value="Search"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <div class="user">
                            <a href="wishlist.php" class="btn wishlist">
                                <i class="fa fa-heart"></i>
                                <span><?php $sql = "SELECT * From Whishlist";
                                        $op = mysqli_query($conn, $sql);
                                        $rows = mysqli_num_rows($op);
                                        echo $rows; ?></span>
                            </a>


                            <a href="cart.php" class="btn cart"><i class="fa fa-shopping-cart"></i><span><?php $sql = "SELECT * From addtocard";
                                                                                                            $op = mysqli_query($conn, $sql);
                                                                                                            $rows = mysqli_num_rows($op);
                                                                                                            echo $rows; ?></span> </a>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bottom Bar End -->