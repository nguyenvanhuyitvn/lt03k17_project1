<?php
    if(!defined('ADMIN') && !defined('STAFF')) {
        header("Location: 403.php");
    }
    include_once "../config/database.php";

    function getOrderStatusLabel($status) {
        switch($status) {
            case 1:
                return '<span class="label label-success">Đã hoàn thành</span>';
            case 2:
                return '<span class="label label-danger">Đã hủy</span>';
            default:
                return '<span class="label label-warning">Đang xử lý</span>';
        }
    }

    $order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
    if($order_id <= 0) {
        header('Location: index.php?page_layout=orders');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
        $order_id = intval($_POST['order_id']);
        $status = isset($_POST['status']) && in_array($_POST['status'], ['0','1','2'], true) ? intval($_POST['status']) : 0;
        mysqli_query($conn, "UPDATE Orders SET status = $status WHERE order_id = $order_id");
        header('Location: index.php?page_layout=order_detail&order_id=' . $order_id);
        exit;
    }

    $sqlOrder = "SELECT * FROM Orders WHERE order_id = $order_id";
    $queryOrder = mysqli_query($conn, $sqlOrder);
    $order = mysqli_fetch_assoc($queryOrder);
    if(!$order) {
        header('Location: index.php?page_layout=orders');
        exit;
    }

    $sqlItems = "SELECT od.*, p.prd_name FROM OrderDetail od LEFT JOIN product p ON od.prd_id = p.prd_id WHERE od.order_id = $order_id";
    $queryItems = mysqli_query($conn, $sqlItems);
    $items = [];
    while($row = mysqli_fetch_assoc($queryItems)) {
        $items[] = $row;
    }

    $orderTotal = number_format($order['amount'], 0, ',', '.');
    $createdAt = $order['created'] ? date('d/m/Y', strtotime($order['created'])) : 'N/A';
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=orders">Quản lý đơn hàng</a></li>
            <li class="active">Chi tiết đơn hàng</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Chi tiết đơn hàng #<?php echo $order['order_id']; ?></h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Thông tin người nhận</div>
                <div class="panel-body">
                    <p><strong>Họ tên:</strong> <?php echo htmlspecialchars($order['user_name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($order['user_email']); ?></p>
                    <p><strong>Điện thoại:</strong> <?php echo htmlspecialchars($order['user_phone']); ?></p>
                    <p><strong>Ngày đặt:</strong> <?php echo $createdAt; ?></p>
                    <p><strong>Tổng tiền:</strong> <?php echo $orderTotal; ?> đ</p>
                    <p><strong>Trạng thái:</strong> <?php echo getOrderStatusLabel($order['status']); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Cập nhật trạng thái</div>
                <div class="panel-body">
                    <form method="post" action="index.php?page_layout=order_detail&order_id=<?php echo $order_id; ?>">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="0"<?php echo ($order['status'] == 0 ? ' selected' : ''); ?>>Đang xử lý</option>
                                <option value="1"<?php echo ($order['status'] == 1 ? ' selected' : ''); ?>>Đã hoàn thành</option>
                                <option value="2"<?php echo ($order['status'] == 2 ? ' selected' : ''); ?>>Đã hủy</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="index.php?page_layout=orders" class="btn btn-default">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Danh sách sản phẩm trong đơn</div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($items) > 0) : ?>
                                <?php $idx = 1; ?>
                                <?php foreach($items as $item) : ?>
                                    <tr>
                                        <td><?php echo $idx++; ?></td>
                                        <td><?php echo htmlspecialchars($item['prd_name'] ?: 'Sản phẩm không xác định'); ?></td>
                                        <td><?php echo intval($item['qty']); ?></td>
                                        <td><?php echo number_format($item['price'], 0, ',', '.'); ?> đ</td>
                                        <td><?php echo number_format($item['qty'] * $item['price'], 0, ',', '.'); ?> đ</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">Không có sản phẩm trong đơn hàng này.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div> <!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
