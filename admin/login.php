<?php
	session_start();
	if(isset($_SESSION['user_login'])) {
		header("Location: index.php");
	}
	include_once "../config/database.php";
	if(isset($_POST['btn_login'])) { //$_POST['btn_login'] chỉ tồn tại khi được bấm nút submit (isset(): kiểm tra biến có tồn tại hay chưa?)
		//validate dữ liệu
		if(empty($_POST['mail'])) { //empty() kiểm tra một biến đã tồn tại và có bị rỗng hay không? Trả về TRUE nếu biến rỗng, FALSE nếu biến có giá trị
			$errors['mail'] = '<p class="text-danger">Email không được để trống.</p>';
		}else{
			$mail = $_POST['mail'];
		}

		if(empty($_POST['pass'])) {
			$errors['pass'] = '<p class="text-danger">Mật khẩu không được để trống.</p>';
		}else{
			$pass = $_POST['pass'];
		}

		if(isset($mail) && isset($pass)) {
			$sql = "SELECT * FROM users WHERE user_mail='$mail' AND user_pass='$pass'";
			$query = mysqli_query($conn, $sql);
			$row = mysqli_num_rows($query);
			if($row > 0) {
				$result = mysqli_fetch_assoc($query); //lấy thông tin tài khoản đăng nhập
				$_SESSION['user_login'] = $result; //lưu trữ thông tin tài khoản đăng nhập vào SESSION, để có thể sử dụng ở các trang khác.
				header("Location: index.php");
			}else{
				$errors['login_fail'] = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
			}
		}
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

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Online Mobile Shop - Administrator</div>
				<div class="panel-body">
					<?php 
						if(isset($errors['login_fail'])) {
							echo $errors['login_fail'];
						}
					?>
					<form action="" role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
								<?php 
									if(isset($errors['mail'])) {
										echo $errors['mail'];
									}
								?>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
								<?php 
									if(isset($errors['pass'])) {
										echo $errors['pass'];
									}
								?>
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
								</label>
							</div>
							<button type="submit" class="btn btn-primary" name="btn_login">Đăng nhập</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>
</html>
