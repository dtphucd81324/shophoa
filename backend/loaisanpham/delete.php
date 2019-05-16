<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $lsp_ma = $_GET['lsp_ma'];
    $sql = "DELETE FROM `loaisanpham` WHERE lsp_ma=".$lsp_ma;

    $result = mysqli_query($conn,$sql);

    //đóng kết nối 
    mysqli_close($conn);

    header('location:index.php');
?>