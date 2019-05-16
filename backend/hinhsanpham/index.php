<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $sql = <<<EOT
    SELECT *
    FROM `hinhsanpham` hsp
    JOIN `sanpham` sp on hsp.sp_ma = sp.sp_ma
EOT;

    $result = mysqli_query($conn, $sql);
    $data = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        //sử dụng hàm sprintf để ứng với các giá trị truyền vào từng vị trí placeholder
        $sp_tomtat = sprintf("Sản phẩm %s, giá: %d",
            $row['sp_ten'],
            number_format($row['sp_gia'], 2, ".", ",") . ' vnđ');

        $data[] = array(
            'hsp_ma' => $row['hsp_ma'],
            'hsp_tentaptin' =>$row['hsp_tentaptin'],
            'sp_tomtat' => $sp_tomtat,
        );
    }
    echo $twig->render('backend/hinhsanpham/index.html.twig',['ds_hinhsanpham' => $data]);
?>