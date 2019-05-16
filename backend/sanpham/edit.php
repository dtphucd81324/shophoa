<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $sqlLoaisanpham = "SELECT * FROM `loaisanpham`";
    $resultLoaisanpham = mysqli_query($conn, $sqlLoaisanpham);

    $dataLoaisanpham = [];
    while($rowLoaisanpham = mysqli_fetch_array($resultLoaisanpham, MYSQLI_ASSOC)){
        $dataLoaisanpham[] = array(
            'lsp_ma' => $rowLoaisanpham['lsp_ma'],
            'lsp_ten' => $rowLoaisanpham['lsp_ten'],
            'lsp_mota' => $rowLoaisanpham['lsp_mota'],
        );
    }

    //truy vấn dữ liệu nhà cung cấp

    $sqlNhacungcap = "SELECT * FROM `nhacungcap`";
    $reslutNhacungcap = mysqli_query($conn, $sqlNhacungcap);

    $dataNhacungcap = [];
    while($rowNhacungcap = mysqli_fetch_array($reslutNhacungcap, MYSQLI_ASSOC)){
        $dataNhacungcap[] = array(
            'ncc_ma' => $rowNhacungcap['ncc_ma'],
            'ncc_ten' => $rowNhacungcap['ncc_ten'],
        );
    }

    //truy vấn dữ liệu khuyến mãi

    $sqlKhuyenmai = "SELECT * FROM `khuyenmai`";
    $resultKhuyenmai = mysqli_query($conn, $sqlKhuyenmai);

    $dataKhuyenmai = [];
    while($rowKhuyenmai = mysqli_fetch_array($resultKhuyenmai, MYSQLI_ASSOC)){
        $km_tomtat = '';
        if(!empty($rowKhuyenmai['km_ten'])){
            $km_tomtat = sprintf("Khuyến mãi %s, nội dung: %s, thời gian: %s-%s",
                $rowKhuyenmai['km_ten'],
                $rowKhuyenmai['km_noidung'],
                //sử dụng hàm date($format, $timestamp) để chuyển đổi ngày định dạng VN
                //sử dụng hàm date() và hàm strtotime() để chuyển đổi
                date('d/m/Y', strtotime($rowKhuyenmai['km_tungay'])),
                date('d/m/Y', strtotime($rowKhuyenmai['km_denngay']))); 
        }
        $dataKhuyenmai[] = array(
            'km_ma' => $rowKhuyenmai['km_ma'],
            'km_tomtat' => $km_tomtat,
        );
    }
    //Lấy giá trị khóa chính đc truyền dạng QueryString Parameter key1=value&key2=value...
    $sp_ma = $_GET['sp_ma'];
    $sqlSelect = "SELECT * FROM `sanpham` WHERE sp_ma=$sp_ma;";

    //thực thi câu lệnh
    $reslutSelect = mysqli_query($conn, $sqlSelect);
    $sanphamRow = mysqli_fetch_array($reslutSelect, MYSQLI_ASSOC);

    if(isset($_POST['btnCapnhat'])){
        $ten = $_POST['sp_ten'];
        $mota = $_POST['sp_mota'];
        $gia = $_POST['sp_gia'];
        $giacu = $_POST['sp_giacu'];
        $ngaycapnhat = $_POST['sp_ngaycapnhat'];
        $soluong = $_POST['sp_soluong'];
        $lsp_ma = $_POST['lsp_ma'];
        $ncc_ma = $_POST['ncc_ma'];
        $km_ma = empty($_POST['km_ma']) ? 'NULL' : $_POST['km_ma'];
        
        $sql = "UPDATE `sanpham` SET sp_ten='$ten', sp_mota='$mota', sp_gia=$gia, sp_giacu=$giacu, sp_ngaycapnhat='$ngaycapnhat', sp_soluong=$soluong, lsp_ma=$lsp_ma, ncc_ma=$ncc_ma, km_ma=$km_ma WHERE sp_ma=$sp_ma;";
        //thực thi
        mysqli_query($conn, $sql);

        //đóng kết nối
        mysqli_close($conn);

        header('location: index.php');
    }
    echo $twig->render('backend/sanpham/edit.html.twig', [
        'ds_loaisanpham' => $dataLoaisanpham,
        'ds_nhacungcap' => $dataNhacungcap,
        'ds_khuyenmai' => $dataKhuyenmai,
        'sanpham' => $sanphamRow,
    ]);
?>