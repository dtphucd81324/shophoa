<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $hsp_ma = $_GET['hsp_ma'];
    $sqlSelect = "SELECT * FROM `hinhsanpham` where hsp_ma=$hsp_ma;";

    $resultSelect = mysqli_query($conn, $sqlSelect);
    $hinhsanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);

    //lấy giá trị khóa chính đc truyền theo dạng QueryString Parameter 
    $hsp_ma = $_GET['hsp_ma'];
    $sql = "DELETE FROM `hinhsanpham` WHERE hsp_ma=" . $hsp_ma;

    $reslut = mysqli_query($conn, $sql);
    //xóa file cũ 
    //đường dẫn để chứa thư mục upload trên ứng dụng web

    $upload_dir = "./../../assets/uploads/";

    $old_file = $upload_dir.$hinhsanphamRow['hsp_tentaptin'];
    if(file_exists($old_file)){
        unlink($old_file);
    }

    //đóng kết nối 
    mysqli_close($conn);

    header('location:index.php');
?>