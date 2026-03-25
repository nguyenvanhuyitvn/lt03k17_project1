<?php
	if (!defined('ADMIN')) { //nếu không phải là Admin thì không được tạo người dùng (không truy cập được)
		header("Location: 403.php");
	}
	//Kết nối đến CSDL
    include_once "../config/database.php";
	if(isset($_GET["users_id"])) {
		$users_id = $_GET['users_id'];
		$sqlGetUserById = "SELECT * FROM users WHERE users_id=$users_id";
		$queryGetUserById = mysqli_query($conn, $sqlGetUserById);
		$rows = mysqli_fetch_assoc($queryGetUserById);
	}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li><a href="">Quản lý thành viên</a></li>
			<li class="active"><?php echo $rows['user_full']; ?></li>
		</ol>
	</div><!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Thành viên: <?php echo $rows['user_full']; ?></h1>
		</div>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-8">
						<?php 
							if(isset($_SESSION['error']['update_fail'])) {
								echo $_SESSION['error']['update_fail'];
								unset($_SESSION['error']['update_fail']);
							}
						
						?>
						<form action="modules/users/user_process.php?action=update&users_id=<?php echo $rows['users_id']; ?>" role="form" method="post">
							<div class="form-group">
								<label>Họ & Tên</label>
								<input type="text" name="user_full" class="form-control" value="<?php echo $rows['user_full']; ?>" placeholder="">
								<?php 
									if(isset($_SESSION['error']['user_full_update_error'])) {
										echo $_SESSION['error']['user_full_update_error'];
										unset($_SESSION['error']['user_full_update_error']);
									}
								?>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="text" name="user_mail" disabled value="<?php echo $rows['user_mail']; ?>" class="form-control">
							</div>
							<div class="form-group">
								<label>Quyền</label>
								<select name="user_level" class="form-control">
									<option value=1 <?php if($rows['user_level'] == 1) echo " selected" ?>>Admin</option>
									<option value=2 <?php if($rows['user_level'] == 2) echo " selected" ?>>Member</option>
								</select>
							</div>
							<button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
							<button type="reset" class="btn btn-default">Làm mới</button>
					</div>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->

</div> <!--/.main-->