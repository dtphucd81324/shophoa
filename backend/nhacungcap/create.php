<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    if(isset($_POST['btnThem'])){
        $tenloai = $_POST['ncc_ten'];
        $mota = $_POST['ncc_mota'];

        //câu lệnh sql
        $sql = "INSERT INTO `nhacungcap` (ncc_ten, ncc_mota) VALUES ('" . $tenloai . "','" . $mota . "');";
        //thực thi
        mysqli_query($conn, $sql);

        //đóng kết nối
        mysqli_close($conn);

        header('location:index.php');
    }
    echo $twig->render('backend/nhacungcap/create.html.twig');
?>