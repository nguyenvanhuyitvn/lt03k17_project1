<?php
session_start();
include "config/database.php";
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    //chuyển mảng chứa id sản phẩm thành chuỗi phân cách bằng dấu phẩy
    $prd_ids = implode(',', array_keys($cart)); // [1,3,5] => "1,3,5"
    //lấy thông tin sản phẩm có id nằm trong chuỗi $prd_ids
    $sqlGetProductsInCart = "SELECT * FROM product WHERE prd_id IN ($prd_ids)";
    $queryGetProductsInCart = mysqli_query($conn, $sqlGetProductsInCart);
?>
    <!--	Cart	-->
    <div id="my-cart">
        <div class="row">
            <div class="cart-nav-item col-lg-5 col-md-5 col-sm-12">Thông tin sản phẩm</div>
            <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Số lượng</div>
            <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Đơn giá</div>
            <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
        </div>
        <form action="process_cart.php?action=update" method="post">
            <?php 
                $total = 0;
                while($row = mysqli_fetch_assoc($queryGetProductsInCart)) {
                $subtotal = $row['prd_price'] * $cart[$row['prd_id']];
                $total +=$subtotal;
            ?>
                <div class="cart-item row">
                    <div class="cart-thumb col-lg-5 col-md-5 col-sm-12">
                        <img src="images/product/<?php echo $row['prd_image']; ?>">
                        <h4><?php echo $row['prd_name']; ?></h4>
                    </div>

                    <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                        <input type="number" id="quantity" name="quantity[<?php echo $row['prd_id']; ?>]" class="form-control form-blue quantity" value="<?php echo $cart[$row['prd_id']]; ?>"
                            min="1">
                    </div>
                    <div class="cart-price col-lg-2 col-md-2 col-sm-12">
                        <b><?php echo number_format($row['prd_price'], 0, ',', '.'); ?>đ</b>
                    </div>
                    <div class="cart-price col-lg-3 col-md-3 col-sm-12">
                        <b><?php echo number_format($subtotal, 0, ',', '.'); ?>đ</b>
                        <a href="#"><i class="fa-solid fa-circle-xmark"></i></a>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                    <button id="update-cart" class="btn btn-success" type="submit" name="sbm_cart_update">Cập nhật
                        giỏ hàng</button>
                </div>
                <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Tổng cộng:</b></div>
                <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($total, 0, ',', '.'); ?>đ</b></div>
            </div>
        </form>

    </div>
    <!--	End Cart	-->

    <!--	Customer Info	-->
    <div id="customer">
        <form method="post">
            <div class="row">

                <div id="customer-name" class="col-lg-4 col-md-4 col-sm-12">
                    <input placeholder="Họ và tên (bắt buộc)" type="text" name="name"
                        class="form-control" required>
                </div>
                <div id="customer-phone" class="col-lg-4 col-md-4 col-sm-12">
                    <input placeholder="Số điện thoại (bắt buộc)" type="text" name="phone"
                        class="form-control" required>
                </div>
                <div id="customer-mail" class="col-lg-4 col-md-4 col-sm-12">
                    <input placeholder="Email (bắt buộc)" type="text" name="mail" class="form-control"
                        required>
                </div>
                <div id="customer-add" class="col-lg-12 col-md-12 col-sm-12">
                    <input placeholder="Địa chỉ nhà riêng hoặc cơ quan (bắt buộc)" type="text"
                        name="add" class="form-control" required>
                </div>

            </div>
        </form>
        <div class="row">
            <div class="by-now col-lg-6 col-md-6 col-sm-12">
                <a href="#">
                    <b>Mua ngay</b>
                    <span>Giao hàng tận nơi siêu tốc</span>
                </a>
            </div>
            <div class="by-now col-lg-6 col-md-6 col-sm-12">
                <a href="#">
                    <b>Trả góp Online</b>
                    <span>Vui lòng call (+84) 03.95.95.4444</span>
                </a>
            </div>
        </div>
    </div>
    <!--	End Customer Info	-->
<?php
} else {
?>
    <p class="text-center">Không có sản phẩm nào trong giỏ hàng</p>
<?php
}
?>