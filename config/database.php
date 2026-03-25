<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'k17_mobile_shop');
    if($conn) {
        mysqli_query($conn, "SET NAMES 'utf8'");
    }else{
        die("Kết nối không thành công.");
    }
?>