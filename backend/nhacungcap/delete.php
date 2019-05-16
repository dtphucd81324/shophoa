<?php 
    require_once __DIR__.'/../../bootstap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $ncc_ma = $_GET['ncc_ma'];
    $sql = "DELETE FROM `nhacungcap` WHERE ncc_ma=" . $ncc_ma;

    //thực thi
    $result = mysqli_query($conn, $sql);

    //đóng kết nối
    mysqli_close($conn);

    header('location:index.php');
?>