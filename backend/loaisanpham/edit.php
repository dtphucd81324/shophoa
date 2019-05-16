<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $lsp_ma = $_GET['lsp_ma'];
    $sqlSelect = "SELECT * FROM `loaisanpham` WHERE lsp_ma = $lsp_ma;";

    $resultSelect = mysqli_query($conn, $sqlSelect);
    $loaisanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);

    if(isset($_POST['btnCapnhat'])){
        $tenloai = $_POST['lsp_ten'];
        $mota = $_POST['lsp_mota'];

        $sql = "UPDATE `loaisanpham` SET lsp_ten = '$tenloai', lsp_mota = '$mota' WHERE lsp_ma =$lsp_ma;";
        //thực thi
        mysqli_query($conn, $sql);

        //đóng kết nối
        mysqli_close($conn);

        header('location: index.php');
    }
    echo $twig->render('backend/loaisanpham/edit.html.twig', ['loaisanpham' => $loaisanphamRow]);
?>