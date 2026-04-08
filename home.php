<?php
include "config/database.php";
?>
<!--	Feature Product	-->
<div class="products">
    <h3>Sản phẩm nổi bật</h3>
    <div class="product-list row">
        <?php
        // Lấy ra 6 sản phẩm nổi bật nhất
        $sqlGetFeatureProducts = "SELECT * FROM product WHERE prd_featured = 1 ORDER BY prd_id DESC LIMIT 6";
        $queryGetFeatureProducts = mysqli_query($conn, $sqlGetFeatureProducts);
        while ($row = mysqli_fetch_assoc($queryGetFeatureProducts)) {
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                <div class="product-item card text-center">
                    <a href="index.php?page=product-detail&prd_id=<?= $row['prd_id'] ?>">
                        <img src="images/product/<?= $row['prd_image'] ?>">
                    </a>
                    <h4>
                        <a href="index.php?page=product-detail&prd_id=<?= $row['prd_id'] ?>"><?= $row['prd_name'] ?></a>
                    </h4>
                    <p>Giá Bán: <span><?= number_format($row['prd_price'], 0, ',', '.') ?>đ</span></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!--	End Feature Product	-->


<!--	Latest Product	-->
<div class="products">
    <h3>Sản phẩm mới</h3>
    <div class="product-list row">
        <?php
        // Lấy ra 6 sản phẩm mới nhất
        $sqlGetLatestProducts = "SELECT * FROM product ORDER BY prd_id DESC LIMIT 6";
        $queryGetLatestProducts = mysqli_query($conn, $sqlGetLatestProducts);
        while ($row = mysqli_fetch_assoc($queryGetLatestProducts)) {
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                <div class="product-item card text-center">
                    <a href="index.php?page=product-detail&prd_id=<?= $row['prd_id'] ?>"><img src="images/product/<?= $row['prd_image'] ?>"></a>
                    <h4><a href="index.php?page=product-detail&prd_id=<?= $row['prd_id'] ?>"><?= $row['prd_name'] ?></a></h4>
                    <p>Giá Bán: <span><?= number_format($row['prd_price'], 0, ',', '.') ?>đ</span></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>