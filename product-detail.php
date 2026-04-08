<?php
include "config/database.php";
if (isset($_GET['prd_id'])) {
    $sqlGetProduct = "SELECT * FROM product WHERE prd_id = " . $_GET['prd_id'];
    $queryGetProduct = mysqli_query($conn, $sqlGetProduct);
    $row = mysqli_fetch_assoc($queryGetProduct);
} else {
    header("Location: index.php");
    exit();
}
?>
<!--	List Product	-->
<div id="product">
    <div id="product-head" class="row">
        <div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
            <img src="images/product/<?php echo $row['prd_image']; ?>">
        </div>
        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
            <h1><?php echo $row['prd_name']; ?></h1>
            <ul>
                <li><span>Bảo hành:</span> <?php echo $row['prd_warranty']; ?></li>
                <li><span>Đi kèm:</span> <?php echo $row['prd_accessories']; ?></li>
                <li><span>Tình trạng:</span> <?php echo $row['prd_new']; ?></li>
                <li><span>Khuyến Mại:</span>
                    <<?php echo $row['prd_promotion']; ?>< /li>
                <li id="price">Giá Bán (chưa bao gồm VAT)</li>
                <li id="price-number"><?= number_format($row['prd_price'], 0, ',', '.') ?>đ</li>
                <li id="status">
                    <?php
                    if ($row['prd_status'] == 1) {
                        echo "<span class='text-success'>Còn hàng</span>";
                    } else {
                        echo "<span class='text-danger'>Hết hàng</span>";
                    }
                    ?>
                </li>
            </ul>
            <div id="add-cart">
                <a href="process_cart.php?action=add&prd_id=<?= $row['prd_id'] ?>">Thêm vào giỏ hàng</a>
                <a href="index.php?page=cart">Mua ngay</a>
            </div>
        </div>
    </div>
    <div id="product-body" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Đánh giá về <?php echo $row['prd_name']; ?></h3>
            <?php echo $row['prd_details']; ?>
        </div>
    </div>

    <!--	Comment	-->
    <div id="comment" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Bình luận sản phẩm</h3>
            <form method="post">
                <div class="form-group">
                    <label>Tên:</label>
                    <input name="comm_name" required type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input name="comm_mail" required type="email" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea name="comm_details" required rows="8" class="form-control"></textarea>
                </div>
                <button type="submit" name="sbm" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
    <!--	End Comment	-->

    <!--	Comments List	-->
    <div id="comments-list" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
            // Code to fetch and display comments
            $totalComments = 0;
            $sqlCountComments = "SELECT COUNT(*) AS total FROM comments WHERE prd_id = " . $_GET['prd_id'];
            $queryCountComments = mysqli_query($conn, $sqlCountComments);
            $resultCountComments = mysqli_fetch_assoc($queryCountComments);
            $totalComments = $resultCountComments['total'];
            $numberOfCommentsToShow = 5; // Số lượng bình luận muốn hiển thị
            $totalPagesComments = ceil($totalComments / $numberOfCommentsToShow);
            if ($totalComments > $numberOfCommentsToShow) {
                echo "<p>Hiển thị $numberOfCommentsToShow trên tổng số $totalComments bình luận</p>";
            } else {
                echo "<p>Tổng số bình luận: $totalComments</p>";
            }
            if (isset($_GET['page_comment'])) {
                $page_comment = $_GET['page_comment'];
            } else {
                $page_comment = 1;
            }

            if ($page_comment < 1) {
                $page_comment = 1;
            }
            if ($page_comment > $totalPagesComments) {
                $page_comment = $totalPagesComments;
            }

            $page_prev = $page_comment - 1;
            if ($page_prev <= 0) {
                $page_prev = 1;
            }

            $page_next = $page_comment + 1;
            if ($page_next > $totalPagesComments) {
                $page_next = $totalPagesComments;
            }
            $start = ($page_comment - 1) * $numberOfCommentsToShow;
            $sqlGetComments = "SELECT * FROM comments WHERE prd_id = " . $_GET['prd_id'] . " ORDER BY comm_id DESC LIMIT $start, $numberOfCommentsToShow";
            $queryGetComments = mysqli_query($conn, $sqlGetComments);
            while ($row = mysqli_fetch_assoc($queryGetComments)) {
            ?>
                <div class="comment-item">
                    <ul>
                        <li><b><?php echo $row['comm_name']; ?></b></li>
                        <li><?php echo $row['comm_date']; ?></li>
                        <li>
                            <p><?php echo $row['comm_details']; ?></p>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
    <!--	End Comments List	-->
</div>
<!--	End Product	-->
<div id="pagination">
    <ul class="pagination">
        <ul class="pagination">
            <?php
            echo '<li class="page-item"><a class="page-link" href="index.php?page_layout=product-detail&prd_id=' . $_GET['prd_id'] . '&page_comment=' . $page_prev . '">&laquo;</a></li>';
            for ($i = 1; $i <= $totalPagesComments; $i++) {
                $active = ($i == $page_comment) ? "active" : "";
                $html = '<li class="page-item ' . $active . '">';
                if ($i == $page_comment) {
                    $html .= '<span class="page-link">' . $i . '</span>';
                } else {
                    $html .= '<a class="page-link" href="index.php?page_layout=product-detail&prd_id=' . $_GET['prd_id'] . '&page_comment=' . $i . '">' . $i . '</a>';
                }
                $html .= '</a></li>';
                echo $html;
            }
            echo '<li class="page-item"><a class="page-link" href="index.php?page_layout=product-detail&prd_id=' . $_GET['prd_id'] . '&page_comment=' . $page_next . '">&raquo;</a></li>';
            ?>
        </ul>
    </ul>
</div>
<!--	End Product	-->