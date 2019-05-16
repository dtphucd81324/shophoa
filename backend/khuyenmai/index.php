<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $stt = 1;
    $sql = "SELECT * FROM `khuyenmai`";

    //thực thi
    $result = mysqli_query($conn, $sql);

    $data = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $data[] = array(
            'km_ma' => $row['km_ma'],
            'km_ten' => $row['km_ten'],
            'km_noidung' => $row['km_noidung'],
            'km_tungay' => $row['km_tungay'],
            'km_denngay' => $row['km_denngay']
        );
    }
    echo $twig->render('backend/khuyenmai/index.html.twig',['ds_khuyenmai' => $data]);
?>