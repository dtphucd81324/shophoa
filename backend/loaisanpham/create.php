<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    if(isset($_POST['btnThem'])){
        $tenloai = $_POST['lsp_ten'];
        $mota = $_POST['lsp_mota'];

        //câu lệnh sql
        $sql = "INSERT INTO `loaisanpham` (lsp_ten, lsp_mota) VALUES ('" . $tenloai . "', '" . $mota . "')";
        mysqli_query($conn, $sql);

        //Đóng kết nối
        mysqli_close($conn);
        header('location: index.php');
    }
    echo $twig->render('backend/loaisanpham/create.html.twig');
?>