<?php
session_start();
$isConfirmed = true;
//Kết nối đến CSDL
include_once "../../../config/database.php";
if ($_GET['action'] == 'delete') {
    $cat_id = $_GET['cat_id'];
    if (empty($cat_id)) {//kiểm tra cat_id có tồn tại hay không?
        header('Location: /mobile_shop/admin/index.php?page_layout=category');
    } else {
        $sqlCheckCatId = "SELECT cat_id FROM category WHERE cat_id=$cat_id"; //kiểm tra cat_id có tồn tại trong bảng category hay không?
        $queryCheckCatId = mysqli_query($conn, $sqlCheckCatId);
        if (mysqli_num_rows($queryCheckCatId) == 0) { //nếu cat_id không tồn tại trong bảng category thì sẽ không thực hiện xóa mà sẽ chuyển hướng về trang category
            header('Location: /mobile_shop/admin/index.php?page_layout=category');
        } else { //nếu cat_id tồn tại trong bảng category thì sẽ thực hiện xóa (thay đổi status về 0)
            $sqlDelete = "UPDATE category SET status=0 WHERE cat_id=$cat_id";
            if (mysqli_query($conn, $sqlDelete)) {
                header('Location: /mobile_shop/admin/index.php?page_layout=category');
            } else {
                echo "Xóa không thành công !";
            }
        }
    }
}

if($_GET['action'] == 'update') {
    $cat_id = $_GET['cat_id'];
    $status = $_POST['status'];
    //kiểm tra xem cat_name đã có thông tin hay chưa?
    if(empty($_POST['cat_name'])) { 
        $_SESSION['error']['cat_name_edit_error'] = '<span class="text-danger">Tên danh mục không được để trống!</span>';
        $isConfirmed = false;
    }else{
        $cat_name = $_POST['cat_name'];
    }

    if($isConfirmed) {
        //Kiểm tra xem cat_name đã tồn tại hay chưa?
        $sqlCheckCatName = "SELECT cat_id FROM category WHERE cat_name='$cat_name' AND cat_id != $cat_id";
        $queryCheckCatName = mysqli_query($conn, $sqlCheckCatName);
        if(mysqli_num_rows($queryCheckCatName) > 0) {
            $_SESSION['error']['category_update_fail'] = '<div class="alert alert-danger">Danh mục đã tồn tại !</div>';
            header("Location: /mobile_shop/admin/index.php?page_layout=edit_category&cat_id=$cat_id");
        }else{
            $sqlUpdate = "UPDATE category SET cat_name='$cat_name', status=$status WHERE cat_id=$cat_id";
            if(mysqli_query($conn, $sqlUpdate)) {
                header('Location: /mobile_shop/admin/index.php?page_layout=category');
            }else{
                $_SESSION['error']['category_update_fail'] = '<div class="alert alert-danger">Cập nhật không thành công !</div>';
                header("Location: /mobile_shop/admin/index.php?page_layout=edit_category&cat_id=$cat_id");
            }
        }
    }
}