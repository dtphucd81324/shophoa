<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $sqlSanpham = "SELECT * FROM `sanpham`";

    $resultSanpham = mysqli_query($conn, $sqlSanpham);

    $dataSanpham = [];
    while($rowSanpham = mysqli_fetch_array($resultSanpham, MYSQLI_ASSOC)){
        $sp_tomtat = sprintf("Sản phẩm %s, giá: %d",
            $rowSanpham['sp_ten'],
            number_format($rowSanpham['sp_gia'], 2, ".", ",") . ' vnđ');
        
        $dataSanpham[] = array(
            'sp_ma' => $rowSanpham['sp_ma'],
            'sp_tomtat' => $sp_tomtat,
        );
    }

    $hsp_ma = $_GET['hsp_ma'];
    $sqlSelect = "SELECT * FROM `hinhsanpham` WHERE hsp_ma=$hsp_ma;";

    $resultSelect = mysqli_query($conn, $sqlSelect);
    $hinhsanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);

    if(isset($_POST['btnCapnhat'])){
        $sp_ma = $_POST['sp_ma'];

        if(isset($_FILES['hsp_tentaptin'])){
            $upload_dir = "./../../assets/uploads/";

            //Nếu file upload bị lỗi thì error > 0 
            if($_FILES['hsp_tentaptin']['error'] > 0){
                echo 'File Upload bị lỗi'; die;
            }
            else{
                //di chuyển file từ thư mục tạm sang thư mục chính
                $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir.$hsp_tentaptin);
                //xóa file cũ
                $old_file = $upload_dir.$hinhsanphamRow['hsp_tentaptin'];
                if(file_exists($old_file)){
                    unlink($old_file);
                }
            }

            $sql = "UPDATE `hinhsanpham` SET hsp_tentaptin = '$hsp_tentaptin', sp_ma=$sp_ma WHERE hsp_ma=$hsp_ma;";

            //thực thi
            mysqli_query($conn, $sql);

            //đóng kết nối 
            mysqli_close($conn);

            header('location: index.php');
        }        
    }
    echo $twig->render('backend/hinhsanpham/edit.html.twig', [
        'ds_sanpham' => $dataSanpham,
        'hinhsanpham' => $hinhsanphamRow,
    ]);
?>