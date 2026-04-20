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

    if(isset($_GET['action']) && isset($_GET['order_id'])) {
        $order_id = intval($_GET['order_id']);
        if($order_id > 0) {
            if($_GET['action'] === 'cancel') {
                mysqli_query($conn, "UPDATE Orders SET status = 2 WHERE order_id = $order_id");
                header('Location: index.php?page_layout=orders');
                exit;
            }
        }
    }

    $filterStatus = '';
    $status = '';
    if(isset($_GET['status']) && in_array($_GET['status'], ['0','1','2'], true)) {
        $status = $_GET['status'];
        $filterStatus = " WHERE status = $status";
    }

    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $rows_per_page = 8;
    $start = $rows_per_page * ($page - 1);

    $sqlGetTotalRecords = "SELECT count(order_id) AS total FROM Orders" . $filterStatus;
    $queryGetTotalRecords = mysqli_query($conn, $sqlGetTotalRecords);
    $resultGetTotalRecords = mysqli_fetch_assoc($queryGetTotalRecords);
    $totalRecords = $resultGetTotalRecords['total'];
    $totalPages = max(1, ceil($totalRecords / $rows_per_page));

    $page_prev = max(1, $page - 1);
    $page_next = min($totalPages, $page + 1);

    $sqlGetAllOrders = "SELECT * FROM Orders" . $filterStatus . " ORDER BY created DESC LIMIT $start, $rows_per_page";
    $queryGetAllOrders = mysqli_query($conn, $sqlGetAllOrders);
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Quản lý đơn hàng</li>
		</ol>
	</div><!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Quản lý đơn hàng</h1>
		</div>
	</div><!--/.row-->

	<div id="toolbar" class="btn-group">
		<a href="index.php?page_layout=orders" class="btn btn-default<?php echo ($status === '' ? ' active' : ''); ?>">
			Tất cả đơn hàng
		</a>
		<a href="index.php?page_layout=orders&status=0" class="btn btn-warning<?php echo ($status === '0' ? ' active' : ''); ?>">
			Chờ xử lý
		</a>
		<a href="index.php?page_layout=orders&status=1" class="btn btn-success<?php echo ($status === '1' ? ' active' : ''); ?>">
			Đơn hàng đã hoàn thành
		</a>
		<a href="index.php?page_layout=orders&status=2" class="btn btn-danger<?php echo ($status === '2' ? ' active' : ''); ?>">
			Đơn hàng đã hủy
		</a>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table data-toolbar="#toolbar" data-toggle="table" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th data-field="id" data-sortable="true">ID</th>
								<th>Người nhận</th>
								<th>Tổng tiền</th>
								<th>Trạng thái</th>
								<th>Ngày tạo</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<?php if(mysqli_num_rows($queryGetAllOrders) > 0) : ?>
								<?php while($rows = mysqli_fetch_assoc($queryGetAllOrders)) : ?>
									<tr>
										<td><?php echo $rows['order_id']; ?></td>
										<td><?php echo htmlspecialchars($rows['user_name']); ?></td>
										<td><?php echo number_format($rows['amount'], 0, ',', '.'); ?> đ</td>
										<td><?php echo getOrderStatusLabel($rows['status']); ?></td>
										<td><?php echo $rows['created'] ? date('d/m/Y', strtotime($rows['created'])) : 'N/A'; ?></td>
										<td class="form-group">
											<a href="index.php?page_layout=order_detail&order_id=<?php echo $rows['order_id']; ?>" class="btn btn-info" title="Xem chi tiết"><i class="glyphicon glyphicon-eye-open"></i></a>
											<a href="index.php?page_layout=order_detail&order_id=<?php echo $rows['order_id']; ?>" class="btn btn-primary" title="Sửa"><i class="glyphicon glyphicon-pencil"></i></a>
											<?php if($rows['status'] != 2) : ?>
												<a href="index.php?page_layout=orders&action=cancel&order_id=<?php echo $rows['order_id']; ?>" class="btn btn-danger" title="Hủy đơn hàng" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?');"><i class="glyphicon glyphicon-remove"></i></a>
											<?php else : ?>
												<button class="btn btn-danger" disabled><i class="glyphicon glyphicon-remove"></i></button>
											<?php endif; ?>
										</td>
									</tr>
								<?php endwhile; ?>
							<?php else : ?>
								<tr>
									<td colspan="7" class="text-center">Không có đơn hàng phù hợp.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item"><a class="page-link" href="index.php?page_layout=orders&page=<?php echo $page_prev . ($status !== '' ? '&status='.$status : ''); ?>">&laquo;</a></li>
							<?php for($i = 1; $i <= $totalPages; $i++) :
								$active = ($i == $page) ? 'active' : '';
							?>
								<li class="page-item <?php echo $active; ?>">
									<?php if($i == $page) : ?>
										<span><?php echo $i; ?></span>
									<?php else : ?>
										<a class="page-link" href="index.php?page_layout=orders&page=<?php echo $i . ($status !== '' ? '&status='.$status : ''); ?>"><?php echo $i; ?></a>
									<?php endif; ?>
								</li>
							<?php endfor; ?>
							<li class="page-item"><a class="page-link" href="index.php?page_layout=orders&page=<?php echo $page_next . ($status !== '' ? '&status='.$status : ''); ?>">&raquo;</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div><!--/.row-->
</div> <!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>