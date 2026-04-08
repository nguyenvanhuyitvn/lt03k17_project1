<?php
session_start();
//Thêm sản phẩm vào giỏ hàng: action = add
if(isset($_GET['action']) && $_GET['action'] == 'add') {
    if(isset($_GET['prd_id'])) {
        $prd_id = $_GET['prd_id'];
        //Nếu sản phẩm đã tồn tại trong giỏ hàng thì tăng số lượng lên 1
        if(isset($_SESSION['cart'][$prd_id])) { 
            $_SESSION['cart'][$prd_id]++;
        } else { 
            //Nếu sản phẩm chưa tồn tại trong giỏ hàng thì thêm mới với số lượng là 1
            $_SESSION['cart'][$prd_id] = 1;
        }
        header('Location: index.php?page=cart');  
    }
}

//Cập nhật thông tin giỏ hàng: action = update

//Xóa sản phẩm khỏi giỏ hàng: action = delete

?>