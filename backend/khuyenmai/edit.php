<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $km_ma = $_GET['km_ma'];
    $sqlSelect = "SELECT * FROM `khuyenmai` WHERE km_ma=$km_ma;";

    $resultSelect = mysqli_query($conn, $sqlSelect);
    $khuyenmaiRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);

    if(isset($_POST['btnCapnhat'])){
        $km_ten = $_POST['km_ten'];
        $km_noidung = $_POST['km_noidung'];
        $km_tungay = $_POST['km_tungay'];
        $km_denngay = $_POST['km_denngay'];

        $sql = "UPDATE `khuyenmai` SET km_ten='$km_ten', km_noidung='$km_noidung', km_tungay='$km_tungay', km_denngay='$km_denngay' WHERE km_ma='$km_ma';";

        //thực thi
        mysqli_query($conn, $sql);

        mysqli_close($conn);
        header('location: index.php');
    }
    echo $twig->render('backend/khuyenmai/edit.html.twig', ['khuyenmai' => $khuyenmaiRow]);
?>