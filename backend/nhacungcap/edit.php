<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $ncc_ma = $_GET['ncc_ma'];
    $sqlSelect = "SELECT * FROM `nhacungcap` WHERE ncc_ma=$ncc_ma;";

    $resultSelect = mysqli_query($conn, $sqlSelect);

    $nhacungcapRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);

    if(isset($_POST['btnCapnhat'])){
        $ten = $_POST['ncc_ten'];
        $mota = $_POST['ncc_mota'];

        $sql = "UPDATE `nhacungcap` SET ncc_ten= '$ten', ncc_mota = '$mota' WHERE ncc_ma=$ncc_ma;";

        //thực thi
        mysqli_query($conn, $sql);

        //đóng kết nối
        mysqli_close($conn);

        header('location:index.php');
    }
    echo $twig->render('backend/nhacungcap/edit.html.twig', ['nhacungcap' => $nhacungcapRow]);
?>