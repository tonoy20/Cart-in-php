<?php include("../server.php") ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shopping Cart</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- owl carousel-->
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <!-- navbar-->
    <header class="header mb-5">
        <!--
      *** TOPBAR ***
      _________________________________________________________
      -->
        <div id="top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offer mb-3 mb-lg-0"><a href="#" class="btn btn-success btn-sm">Offer of the day</a><a href="#" class="ml-1">Get flat 35% off on orders over $50!</a></div>
                    <div class="col-lg-6 text-center text-lg-right">
                        <ul class="menu list-inline mb-0">
                            <?php 
                                session_start(); 

                                if(isset($_SESSION['uname'])) {
                                    ?>
                                        <li class="list-inline-item"><a href="userhome.php"><?php echo $_SESSION['uname'] ?></a></li>
                                        <li class="list-inline-item"><a href="../logout.php">Log out</a></li>
                                        <li class="list-inline-item"><a href="">Contact</a></li>
                                        <li class="list-inline-item h5"><a href="userOrderShow.php">My Orders</a></li>
                                    <?php
                                } else {
                            ?>
                            <li class="list-inline-item"><a href="../login.php">Login</a></li>
                            <li class="list-inline-item"><a href="registerUser.php">Register</a></li>
                            <li class="list-inline-item"><a href="">Contact</a></li>
                            <?php 
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg">
            <div class="container"><a href="" class="navbar-brand home"><span class="sr-only">Shopping Cart</span></a>
                <div class="navbar-buttons">
                    <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
                    <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
                </div>
                <div id="navigation" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="userhome.php" class="nav-link active">Home</a></li>
                        <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">Categories<b class="caret"></b></a>
                            <ul class="dropdown-menu megamenu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3">
                                            <?php
                                            $sql = "SELECT * FROM `categories`";
                                            $q_run = mysqli_query($data, $sql);
                                            while ($row = mysqli_fetch_assoc($q_run)) {
                                            ?>
                                                <ul class="list-unstyled mb-3">
                                                    <a href="categoryProduct.php?cat_id=<?= $row['id'] ?>"> <li class="nav-item" class="nav-link"><?= $row['title'] ?></li></a>
                                                <?php
                                            }
                                                ?>
                                                </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">NEW ARRIVAL<b class="caret"></b></a>
                            <ul class="dropdown-menu megamenu">
                                <li>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3">
                                            <h5>Shop</h5>
                                            <ul class="list-unstyled mb-3">
                                            <?php
                                                $sql1 = "SELECT * FROM products GROUP BY id DESC LIMIT 4";
                                                $res1 = mysqli_query($data, $sql1);
                                                while($row1 = mysqli_fetch_assoc($res1)) {
                                                    ?>
                                                        <li class="nav-item"><a href="productDetail.php?re=<?= $row1['id'] ?>" class="nav-link"><?php echo $row1['name'] ?></a></li>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="navbar-buttons d-flex justify-content-end">
                        <!-- /.nav-collapse-->
                        <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>
                        <?php 
                            $cnt = 0;
                            if(isset($_SESSION['cart'])) {
                                $cnt = count($_SESSION['cart']);
                            }
                        ?>
                        <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block"><a href="userCart.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i>cart<span class="badge rounded badge-notification bg-secondary"><?php echo $cnt ?></span></a></div>
                    </div>
                </div>
            </div>
        </nav>
        <div id="search" class="collapse">
            <div class="container">
                <form role="search" class="ml-auto">
                    <div class="input-group">
                        <input type="text" placeholder="Search" class="form-control">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </header>