<?php 
	session_start();
	// session_destroy(); 
	if(!isset($_SESSION['user_login'])) {
		header("Location: login.php");
	}
	// echo "<pre>";
	// echo '$_SESSION[] = ';
	// print_r($_SESSION);
	// echo '$_SESSION["user_login"] = ';
	// print_r($_SESSION['user_login']);

	// echo '$_SESSION["user_login"["user_level"] = ';
	// echo ($_SESSION['user_login']['user_level']);
	// die;
	if($_SESSION['user_login']['user_level'] == 1) {
		define("ADMIN",true);
	}else if($_SESSION['user_login']['user_level'] == 2) {
		define("STAFF", true);
	}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Mobile Shop - Administrator</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/bootstrap-table.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">

	<!--Icons-->
	<script src="js/lumino.glyphs.js"></script>

	<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Mobile</span>Shop</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user">
								<use xlink:href="#stroked-male-user"></use>
							</svg> 
							<?php 
								if(isset($_SESSION['user_login'])) {
									echo $_SESSION['user_login']['user_full'];
								}
							?> 
							<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user">
										<use xlink:href="#stroked-male-user"></use>
									</svg> Hồ sơ</a></li>
							<li><a href="logout.php"><svg class="glyph stroked cancel">
										<use xlink:href="#stroked-cancel"></use>
									</svg> Đăng xuất</a></li>
						</ul>
					</li>
				</ul>
			</div>

		</div><!-- /.container-fluid -->
	</nav>
	<!-- ./Navigation -->
	<!-- Sidebar -->
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="index.php"><svg class="glyph stroked dashboard-dial">
						<use xlink:href="#stroked-dashboard-dial"></use>
					</svg> Dashboard</a></li>
			<li><a href="index.php?page_layout=user"><svg class="glyph stroked male user ">
						<use xlink:href="#stroked-male-user" />
					</svg>Quản lý thành viên</a></li>
			<li><a href="index.php?page_layout=category"><svg class="glyph stroked open folder">
						<use xlink:href="#stroked-open-folder" />
					</svg>Quản lý danh mục</a></li>
			<li><a href="index.php?page_layout=product"><svg class="glyph stroked bag">
						<use xlink:href="#stroked-bag"></use>
					</svg>Quản lý sản phẩm</a></li>
			<li><a href="index.php?page_layout=orders"><svg class="glyph stroked bag">
						<use xlink:href="#stroked-bag"></use>
					</svg>Quản lý đơn hàng</a></li>
			<li><a href="index.php?page_layout=comment"><svg class="glyph stroked two messages">
						<use xlink:href="#stroked-two-messages" />
					</svg> Quản lý bình luận</a></li>
			<li><a href="index.php?page_layout=adds"><svg class="glyph stroked chain">
						<use xlink:href="#stroked-chain" />
					</svg> Quản lý quảng cáo</a></li>
			<li><a href="index.php?page_layout=setting"><svg class="glyph stroked gear">
						<use xlink:href="#stroked-gear" />
					</svg> Cấu hình</a></li>
		</ul>

	</div>
	<!--/.sidebar-->
	<!-- Main Content -->

	<?php
        if(isset($_GET['page_layout'])) {
            switch ($_GET['page_layout']) {
                case 'category': include_once 'modules/categories/category.php';
                    break;
                case 'add_category': include_once 'modules/categories/add_category.php';
                    break;
                case 'edit_category': include_once 'modules/categories/edit_category.php';
                    break;
                case 'product': include_once 'modules/products/product.php';
                    break;
                case 'add_product': include_once 'modules/products/add_product.php';
                    break;
                case 'edit_product': include_once 'modules/products/edit_product.php';
                    break;
                case 'user': include_once 'modules/users/user.php';
                    break;
                case 'add_user': include_once 'modules/users/add_user.php';
                    break;
                case 'edit_user': include_once 'modules/users/edit_user.php';
                    break;
                case 'orders': include_once 'modules/orders/orders.php';
                    break;
                case 'order_detail': include_once 'modules/orders/order_detail.php';
                    break;
                default: header('Location: 404.php');
            }
        } else {
            include_once 'modules/dashboard/admin.php';
        }
    ?>

    <!--/.Main Content-->
</body>

</html>