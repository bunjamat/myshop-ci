<?php
$user_id =  $this->session->userdata('user_id');
$nickname =  $this->session->userdata('nickname');
$role_user =  $this->session->userdata('');
$logged_in =  $this->session->userdata('logged_in');

?>
<!doctype html>
<html class="no-js" lang="th">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/eshop/css/bootstrap.min.css">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/eshop/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/eshop/css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/eshop/css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/eshop/css/shortcode/shortcodes.css?ts=<?= date("His") ?>">
    <!-- Theme main style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/eshop/style.css?ts=<?= date("His") ?>">
    <!-- Responsive css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/eshop/css/responsive.css?ts=<?= date("His") ?>">
    <!-- User style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/eshop/css/custom.css?ts=<?= date("His") ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- jquery latest version -->
    <script src="<?= base_url() ?>assets/eshop/js/vendor/jquery-1.12.0.min.js"></script>

    <style>
        .quantity-input {
            max-width: 200px;
        }

        .badge_cart {
            background: red;
            margin-left: 5px;
            color: #fff !important;
            padding: 0 5px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            line-height: 0.8;
            vertical-align: super;
        }
    </style>


    <!-- Modernizr JS -->
    <script src="<?= base_url() ?>assets/eshop/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <!-- fixed__footer -->
    <div class="wrapper ">
        <!-- Start Header Style -->
        <header id="header" class="htc-header header--3 bg__white">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                            <div class="logo">
                                <a href="<?= base_url() ?>">
                                    Shop name
                                    <!-- <img src="images/logo/logo.png" alt="logo"> -->
                                </a>
                            </div>
                        </div>
                        <!-- Start MAinmenu Ares -->
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                            <nav class="mainmenu__nav hidden-xs hidden-sm">
                                <ul class="main__menu">
                                    <li class="drop"><a href="<?= base_url() ?>">หน้าแรก</a></li>
                                    <!-- <li class="drop"><a href="shop">หมวดหมู่สินค้า</a></li> -->
                                    <li class="drop"><a href="<?= base_url() ?>shop">สินค้าทั้งหมด</a></li>
                                    <?php if ($logged_in) { ?>
                                        <li><a href="<?= base_url() ?>order/tracking">รายการสั่งซื้อของฉัน</a></li>
                                    <?php }  ?>



                                    <!-- <li class="drop"><a href="shop">แจ้งชำระเงิน</a></li> -->
                                    <li><a href="#">ติดต่อเรา</a></li>
                                </ul>
                            </nav>
                            <div class="mobile-menu clearfix visible-xs visible-sm">
                                <nav id="mobile_dropdown">
                                    <ul>
                                        <li><a href="<?= base_url() ?>">หน้าแรก</a></li>
                                        <li><a href="<?= base_url() ?>shop">สินค้าทั้งหมด</a></li>
                                        <?php if ($logged_in) { ?>
                                            <li><a href="<?= base_url() ?>order/tracking">รายการสั่งซื้อของฉัน</a></li>
                                        <?php }  ?>
                                        <li><a href="#">ติดต่อเรา</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- End MAinmenu Ares -->
                        <div class="col-md-4 col-sm-4 col-xs-3">
                            <ul class="menu-extra">
                                <!-- <li class="search search__open hidden-xs"><span class="ti-search"></span></li> -->
                                <?php if ($logged_in) { ?>
                                    <!-- <li><a href="#"><i class="ti-user"></i> Account</a></li> -->
                                    <li><a href="<?= base_url() ?>users/profile"><i class="ti-user"></i> Account</a></li>
                                    <li><a href="<?= base_url() ?>users/authen/logout"><i class="ti-unlock"></i> Logout</a></li>
                                <?php } else { ?>

                                    <li><a href="<?= base_url() ?>users/authen"><i class="ti-lock"></i> Login</a></li>
                                <?php } ?>
                                <li class="cart__menu__"><a href="cart"><span class="ti-shopping-cart"></span><span class="badge_cart"><?= $this->cart->total_items() ?></span><br></a></li>
                                <!-- <li class="toggle__menu hidden-xs hidden-sm"><span class="ti-menu"></span></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Style -->

        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="#" method="get">
                                    <input placeholder="Search here... " type="text">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
            <!-- Start Offset MEnu -->
            <div class="offsetmenu">
                <div class="offsetmenu__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="off__contact">
                        <div class="logo">
                            <a href="index.html">
                                <img src="images/logo/logo.png" alt="logo">
                            </a>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetu adipisicing elit sed do eiusmod tempor incididunt ut labore.</p>
                    </div>
                    <ul class="sidebar__thumd">
                        <li><a href="#"><img src="images/sidebar-img/1.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images/sidebar-img/2.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images/sidebar-img/3.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images/sidebar-img/4.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images/sidebar-img/5.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images/sidebar-img/6.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images/sidebar-img/7.jpg" alt="sidebar images"></a></li>
                        <li><a href="#"><img src="images/sidebar-img/8.jpg" alt="sidebar images"></a></li>
                    </ul>
                    <div class="offset__widget">
                        <div class="offset__single">
                            <h4 class="offset__title">Language</h4>
                            <ul>
                                <li><a href="#"> Engish </a></li>
                                <li><a href="#"> French </a></li>
                                <li><a href="#"> German </a></li>
                            </ul>
                        </div>
                        <div class="offset__single">
                            <h4 class="offset__title">Currencies</h4>
                            <ul>
                                <li><a href="#"> USD : Dollar </a></li>
                                <li><a href="#"> EUR : Euro </a></li>
                                <li><a href="#"> POU : Pound </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="offset__sosial__share">
                        <h4 class="offset__title">Follow Us On Social</h4>
                        <ul class="off__soaial__link">
                            <li><a class="bg--twitter" href="#" title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>

                            <li><a class="bg--instagram" href="#" title="Instagram"><i class="zmdi zmdi-instagram"></i></a></li>

                            <li><a class="bg--facebook" href="#" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>

                            <li><a class="bg--googleplus" href="#" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a></li>

                            <li><a class="bg--google" href="#" title="Google"><i class="zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Offset MEnu -->
            <!-- Start Cart Panel -->
            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product/sm-img/1.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$105.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product/sm-img/2.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">Brone Candle</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$25.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price">$130.00</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="./cart">ไปที่ตระกร้าสินค้า</a></li>
                        <li class="shp__checkout"><a href="checkout.html">สั่งซื้อสินค้าและชำระเงิน</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->