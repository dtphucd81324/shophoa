<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $km_ma = $_GET['km_ma'];
    $sql = "DELETE FROM `khuyenmai` WHERE km_ma=" . $km_ma;

    mysqli_query($conn, $sql);

    //đóng kết nối
    mysqli_close($conn);

    header('location:index.php');
?>