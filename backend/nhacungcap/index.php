<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $stt = 1;
    $sql = "SELECT * FROM `nhacungcap`";

    //thực thi
    $result = mysqli_query($conn, $sql);
    $data = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $data[] = array(
            'ncc_ma' => $row['ncc_ma'],
            'ncc_ten' => $row['ncc_ten'],
            'ncc_mota' => $row['ncc_mota'],
        );
    }
    echo $twig->render('backend/nhacungcap/index.html.twig',['ds_nhacungcap' => $data]);
?>