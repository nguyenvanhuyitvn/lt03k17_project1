<?php
    ob_start(); //output buffer
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/category.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/success.css">
    <link rel="stylesheet" href="css/cart.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
</head>

<body>
    <!--	Header	-->
    <div id="header">
        <div class="container">
            <div class="row">
                <div id="logo" class="col-lg-3 col-md-3 col-sm-12">
                    <h1><a href="#"><img class="img-fluid" src="images/logo-webleaners-png.png"></a></h1>
                </div>
                <div id="search" class="col-lg-6 col-md-6 col-sm-12">
                    <form class="form-inline">
                        <input class="form-control mt-3" type="search" placeholder="Tìm kiếm" aria-label="Search">
                        <button class="btn btn-danger mt-3" type="submit">Tìm kiếm</button>
                    </form>
                </div>
                <div id="cart" class="col-lg-3 col-md-3 col-sm-12">
                    <a class="mt-4 mr-2" href="#">giỏ hàng
                        <i class="fa-solid fa-cart-shopping cart-icon">
                            <span class="mt-3">8</span></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <!--	End Header	-->

    <!--	Body	-->
    <div id="body">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <nav>
                        <div id="menu" class="collapse navbar-collapse">
                            <ul>
                                <li class="menu-item"><a href="#">iPhone</a></li>
                                <li class="menu-item"><a href="#">Samsung</a></li>
                                <li class="menu-item"><a href="#">HTC</a></li>
                                <li class="menu-item"><a href="#">Nokia</a></li>
                                <li class="menu-item"><a href="#">Sony</a></li>
                                <li class="menu-item"><a href="#">Blackberry</a></li>
                            </ul>
                        </div>
                    </nav>
                    <!-- <form class="form-inline">
                    <input class="form-control mt-3" type="search" placeholder="Tìm kiếm" aria-label="Search">
                    <button class="btn btn-danger mt-3" type="submit">Tìm kiếm</button>
                </form> -->
                </div>
            </div>
            <div class="row">
                <div id="main" class="col-lg-8 col-md-12 col-sm-12">
                    <!--	Slider	-->
                    <div id="slide" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <li data-target="#slide" data-slide-to="0" class="active"></li>
                            <li data-target="#slide" data-slide-to="1"></li>
                            <li data-target="#slide" data-slide-to="2"></li>
                            <li data-target="#slide" data-slide-to="3"></li>
                            <li data-target="#slide" data-slide-to="4"></li>
                            <li data-target="#slide" data-slide-to="5"></li>
                        </ul>

                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/slide/slide-1.png" alt="Webleaners Training">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slide/slide-2.png" alt="Webleaners Training">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slide/slide-3.png" alt="Webleaners Training">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slide/slide-4.png" alt="Webleaners Training">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slide/slide-5.png" alt="Webleaners Training">
                            </div>
                            <div class="carousel-item">
                                <img src="images/slide/slide-6.png" alt="Webleaners Training">
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#slide" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#slide" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>

                    </div>
                    <!--	End Slider	-->
                    <!-- Main Content -->
                    <?php
                    
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        switch ($page) {
                            case 'category-product':
                                include_once "category-product.php";
                                break;
                            case 'product-detail':
                                include_once "product-detail.php";
                                break;
                            case 'search-result':
                                include_once "search-result.php";
                                break;
                            case 'cart':
                                include_once "cart.php";
                                break;
                            case 'success':
                                include_once "success.php";
                                break;
                            default: header("Location: 404.php");
                                ob_end_flush();
                                break;
                        }
                    } else {
                        include_once "home.php";
                    }

                    ?>

                    <!-- ./Main Content -->

                </div>

                <div id="sidebar" class="col-lg-4 col-md-12 col-sm-12">
                    <div id="banner">
                        <div class="banner-item">
                            <a href="#"><img class="img-fluid" src="images/banner/banner-1.png"></a>
                        </div>
                        <div class="banner-item">
                            <a href="#"><img class="img-fluid" src="images/banner/banner-2-2.png"></a>
                        </div>
                        <div class="banner-item">
                            <a href="#"><img class="img-fluid" src="images/banner/banner-3.png"></a>
                        </div>
                        <div class="banner-item">
                            <a href="#"><img class="img-fluid" src="images/banner/banner-4.png"></a>
                        </div>
                        <div class="banner-item">
                            <a href="#"><img class="img-fluid" src="images/banner/banner-5.png"></a>
                        </div>
                        <div class="banner-item">
                            <a href="#"><img class="img-fluid" src="images/banner/banner-6.png"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--	End Body	-->

    <div id="footer-top">
        <div class="container">
            <div class="row">
                <div id="logo-2" class="col-lg-3 col-md-6 col-sm-12">
                    <h2><a href="#"><img src="images/logo-webleaners-png.png"></a></h2>
                    <p>
                        <strong>Web Learners Academy</strong> Chúng tôi đào tạo chuyên sâu trong 2 lĩnh vực là Lập trình Website & Mobile nhằm cung cấp cho thị trường CNTT Việt Nam những lập trình viên thực sự chất lượng, có khả năng làm việc độc lập, cũng như Team Work ở mọi môi trường đòi hỏi sự chuyên nghiệp cao.
                    </p>
                </div>
                <div id="address" class="col-lg-3 col-md-6 col-sm-12">
                    <h3>Địa chỉ</h3>
                    <p>Hưng Thịnh - Yên Sở Hoàng Mai - Hà Nội</p>
                    <p>Hưng Thịnh - Yên Sở Hoàng Mai - Hà Nội</p>
                </div>
                <div id="service" class="col-lg-3 col-md-6 col-sm-12">
                    <h3>Dịch vụ</h3>
                    <p>Bảo hành rơi vỡ, ngấm nước Care Diamond</p>
                    <p>Bảo hành Care X60 rơi vỡ ngấm nước vẫn Đổi mới</p>
                </div>
                <div id="hotline" class="col-lg-3 col-md-6 col-sm-12">
                    <h3>Hotline</h3>
                    <p>Phone Sale: (+84) 0395954444</p>
                    <p>Email: huynguyenhuynv@gmail.com</p>
                </div>
            </div>
        </div>
    </div>

    <!--	Footer	-->
    <div id="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <p>
                        2022 © Webleaners Training. All rights reserved. Developed by Webleaners Training.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--	End Footer	-->
</body>

</html>