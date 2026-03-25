<?php
	if (!defined('ADMIN')) { //nếu không phải là Admin thì không được tạo người dùng (không truy cập được)
		header("Location: 403.php");
	}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li><a href="">Quản lý thành viên</a></li>
			<li class="active">Thêm thành viên</li>
		</ol>
	</div><!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Thêm thành viên</h1>
		</div>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-8">
						<?php 
							if(isset($_SESSION['error']['insert_fail'])) {
								echo $_SESSION['error']['insert_fail'];
								unset($_SESSION['error']['insert_fail']);
							}
						?>
						<form action="modules/users/user_process.php?action=create" role="form" method="post">
							<div class="form-group">
								<label>Họ & Tên</label>
								<input name="user_full" 
								  class="form-control" 
								  placeholder=""
								  value="<?php if(isset($_SESSION['old_value']['user_full_create'])) {
										echo $_SESSION['old_value']['user_full_create'];
										unset($_SESSION['old_value']['user_full_create']);
									} 
								  ?>" 
								  >
								<?php 
									if(isset($_SESSION['error']['user_full_edit_error'])) {
										echo $_SESSION['error']['user_full_edit_error'];
										unset($_SESSION['error']['user_full_edit_error']);
									}
								?>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input 
									name="user_mail"  
									type="email" 
									class="form-control"
									value="<?php if(isset($_SESSION['old_value']['user_mail_create'])) {
											echo $_SESSION['old_value']['user_mail_create'];
											unset($_SESSION['old_value']['user_mail_create']);
										}?>" >
								<?php 
									if(isset($_SESSION['error']['user_mail_create_error'])) {
										echo $_SESSION['error']['user_mail_create_error'];
										unset($_SESSION['error']['user_mail_create_error']);
									}
								?>
							</div>
							<div class="form-group">
								<label>Quyền</label>
								<select name="user_level" class="form-control">
									<option value=1>Admin</option>
									<option value=2>Member</option>
								</select>
							</div>
							<button name="sbm_create" type="submit" class="btn btn-success">Thêm mới</button>
							<button type="reset" class="btn btn-default">Làm mới</button>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->

</div> <!--/.main-->