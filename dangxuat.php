<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Đăng xuất</title>
</head>
<?php 
    include_once('dbconnect.php');
    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
        header('location:dangnhap.php');
    }
    else{
        echo 'Bạn chưa đăng nhập vào hệ thống! Vui lòng đăng nhập vào hệ thống!';
    }
?>
</html>