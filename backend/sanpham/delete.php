<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $sp_ma = $_GET['sp_ma'];
    $sql = "DELETE FROM `sanpham` where sp_ma=" . $sp_ma;

    //thực thi câu lệnh
    mysqli_query($conn, $sql);

    //đóng kết nối
    mysqli_close($conn);

    header('location: index.php');
?>