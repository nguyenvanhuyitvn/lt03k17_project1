<?php
	if (!defined('ADMIN')) { //nếu không phải là Admin thì không được tạo người dùng (không truy cập được)
		header("Location: 403.php");
	}
	//Kết nối đến CSDL
    include_once "../config/database.php";
	if(isset($_GET["cat_id"])) {
		$cat_id = $_GET['cat_id'];
		$sqlGetCatById = "SELECT * FROM category WHERE cat_id=$cat_id";
		$queryGetCatById = mysqli_query($conn, $sqlGetCatById);
		$rows = mysqli_fetch_assoc($queryGetCatById);
	}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li><a href="">Quản lý danh mục</a></li>
			<li class="active"><?php echo $rows['cat_name']; ?></li>
		</ol>
	</div><!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Danh mục:<?php echo $rows['cat_name']; ?></h1>
		</div>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-8">
						<?php 
							if(isset($_SESSION['error']['category_update_fail'])) {
								echo $_SESSION['error']['category_update_fail'];
								unset($_SESSION['error']['category_update_fail']);
							}
						?>
						<form action="modules/categories/category_process.php?action=update&cat_id=<?php echo $rows['cat_id']; ?>" role="form" method="post">
							<div class="form-group">
								<label>Tên danh mục:</label>
								<input type="text" name="cat_name" required value="<?php echo $rows['cat_name']; ?>" class="form-control" placeholder="Tên danh mục...">
								<?php 
									if(isset($_SESSION['error']['cat_name_edit_error'])) {
										echo $_SESSION['error']['cat_name_edit_error'];
										unset($_SESSION['error']['cat_name_edit_error']);
									}
								?>
							</div>
							<div class="form-group">
								<label>Trạng thái</label>
								<select name="status" class="form-control">
									<option value=1 <?php if($rows['status'] == 1) echo " selected" ?>>Đang hoạt động</option>
									<option value=0 <?php if($rows['status'] == 0) echo " selected" ?>>Ngừng hoạt động</option>
								</select>
							</div>
							<button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
							<button type="reset" class="btn btn-default">Làm mới</button>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.col-->
	</div> <!--/.main-->