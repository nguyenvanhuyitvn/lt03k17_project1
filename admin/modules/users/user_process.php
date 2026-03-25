<?php 
    session_start();
    //Kết nối đến CSDL
    include_once "../../../config/database.php";
    $isConfirmed = true;
    $_SESSION['error'] = array();
    //Kiểm tra xem đã bấm nút thêm mới hay chưa?
    if($_GET['action'] == 'create') {
        if(empty($_POST['user_full'])) { //nếu input user_full chưa nhập thông tin => true
            $_SESSION['error']['user_full_create_error'] = '<span class="text-danger">Tên người dùng không được để trống!</span>';
            $isConfirmed = false;
        }else{
            $user_full = $_POST['user_full'];
            $_SESSION['old_value']['user_full_create'] = $_POST['user_full'];
        }
        if(empty($_POST['user_mail'])) {
            $_SESSION['error']['user_mail_create_error'] = '<span class="text-danger">Email không được để trống!</span>';
            $isConfirmed = false;
        }else{
            $user_mail = $_POST['user_mail'];
            $_SESSION['old_value']['user_mail_create'] = $_POST['user_mail'];
        }
        //Gán giá trị cho $user_level
        $user_level = $_POST['user_level'];

        if(!$isConfirmed) {
            header("Location: /mobile_shop/admin/index.php?page_layout=add_user");
        }else{
            //Kiểm tra email vừa nhập đã tồn tại hay chưa?
            $sqlGetUserByEmail = "SELECT users_id FROM users WHERE user_mail='$user_mail'";
            $queryGetUserByEmail = mysqli_query($conn, $sqlGetUserByEmail);
            if(mysqli_num_rows($queryGetUserByEmail) > 0) {
                $_SESSION['error']['insert_fail'] = '<div class="alert alert-danger">Email đã tồn tại !</div>';
                header("Location: /mobile_shop/admin/index.php?page_layout=add_user");
            }else{
                //Thêm bản ghi mới
                $sqlInsert = "INSERT INTO users(user_full, user_mail, user_level, user_pass) VALUES ('$user_full', '$user_mail', '$user_level','123456')";
                if(mysqli_query($conn, $sqlInsert)) {
                    header('Location: /mobile_shop/admin/index.php?page_layout=user');
                }else{
                    $_SESSION['error']['insert_fail'] = '<div class="alert alert-danger">Thêm không thành công !</div>';
                    header("Location: /mobile_shop/admin/index.php?page_layout=add_user");
                }
            }
            
        }
    }

    if($_GET['action'] == 'update') {
        $users_id = $_GET['users_id'];
        if(empty($_POST['user_full'])) { //nếu input user_full chưa nhập thông tin => true
            $_SESSION['error']['user_full_edit_error'] = '<span class="text-danger">Tên người dùng không được để trống!</span>';
            $isConfirmed = false;
        }else{
            $user_full = $_POST['user_full'];
        }
       
        //Gán giá trị cho $user_level
        $user_level = $_POST['user_level'];

        if(!$isConfirmed) {
            header("Location: /mobile_shop/admin/index.php?page_layout=edit_user");
        }else{
            //Cập nhật thông tin bản ghi
            $sqlInsert = "UPDATE users SET user_full='$user_full', user_level='$user_level' WHERE users_ud='$users_id'";
            if(mysqli_query($conn, $sqlInsert)) {
                header('Location: /mobile_shop/admin/index.php?page_layout=user');
            }else{
                $_SESSION['error']['update_fail'] = '<div class="alert alert-danger">Cập nhật không thành công !</div>';
                header("Location: /mobile_shop/admin/index.php?page_layout=add_user");
            }            
        }
    }

    if($_GET['action'] == 'delete') {
        echo "Delete user";
    }

    if($_GET['action'] == 'reset_password') {
        $users_id = $_GET["users_id"];
        $sqlResetPassword = "UPDATE users SET user_pass='123456' WHERE users_id='$users_id'";
    }
?>