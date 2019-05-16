<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    if(isset($_POST['btnThem'])){
        $km_ma = $_POST['km_ma'];
        $km_ten = $_POST['km_ten'];
        $km_noidung = $_POST['km_noidung'];
        $km_tungay = $_POST['km_tungay'];
        $km_denngay = $_POST['km_denngay'];

        $sql = "INSERT INTO `khuyenmai` (km_ten, km_noidung, km_tungay, km_denngay) VALUES ('$km_ten', '$km_noidung', '$km_tungay', '$km_denngay');";

        mysqli_query($conn, $sql);

        //đóng kết nối
        mysqli_close($conn);

        header('location:index.php');
    }
    echo $twig->render('backend/khuyenmai/create.html.twig');
?>