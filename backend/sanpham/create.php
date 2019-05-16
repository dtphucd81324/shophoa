<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');
    $sqlSelect = "SELECT * FROM `loaisanpham`";

    $resultSelect = mysqli_query($conn, $sqlSelect);
    $dataLoaisanpham = [];

    while($rowLoaisanpham = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)){
        $dataLoaisanpham[] = array(
            'lsp_ma' => $rowLoaisanpham['lsp_ma'],
            'lsp_ten' => $rowLoaisanpham['lsp_ten'],
            'lsp_mota' => $rowLoaisanpham['lsp_mota'],
        );
    }

    //truy vấn dữ liệu nhà cung cấp
    $sqlNhacungcap = "SELECT * FROM `nhacungcap`";

    $resultNhacungcap = mysqli_query($conn, $sqlNhacungcap);

    $dataNhacungcap = [];
    while($rowNhacungcap = mysqli_fetch_array($resultNhacungcap, MYSQLI_ASSOC)){
        $dataNhacungcap[] = array(
            'ncc_ma' => $rowNhacungcap['ncc_ma'],
            'ncc_ten' => $rowNhacungcap['ncc_ten'],
            'ncc_mota' => $rowNhacungcap['ncc_mota'],
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
                //Sử dụng hàm date($format, $timestamp)
                //Sử dụng hàm strtotime() để chuyển về định dạng ngày Việt Nam
                date('d/m/Y', strtotime($rowKhuyenmai['km_tungay'])),
                date('d/m/Y', strtotime($rowKhuyenmai['km_denngay'])));
        }
        $dataKhuyenmai[] = array(
            'km_ma' => $rowKhuyenmai['km_ma'],
            'km_tomtat' => $km_tomtat,
        );
    }
    if(isset($_POST['btnThem'])){
        $ten = $_POST['sp_ten'];
        $mota = $_POST['sp_mota'];
        $gia = $_POST['sp_gia'];
        $giacu = $_POST['sp_giacu'];
        $soluong = $_POST['sp_soluong'];
        $ngaycapnhat = $_POST['sp_ngaycapnhat'];
        $lsp = $_POST['lsp_ma'];
        $ncc = $_POST['ncc_ma'];
        $km = $_POST['km_ma'];
        
        $sql = "INSERT INTO `sanpham` (sp_ten, sp_mota, sp_gia, sp_giacu, sp_ngaycapnhat, sp_soluong, lsp_ma, ncc_ma, km_ma) VALUES ('$ten', '$mota', $gia, $giacu, '$ngaycapnhat', $soluong, $lsp, $ncc, $km);";
        //var_dump($sql); die;

        //thực thi câu lệnh
        mysqli_query($conn, $sql);

        //đóng kết nối
        mysqli_close($conn);

        header('location: index.php');
    }
    echo $twig->render('backend/sanpham/create.html.twig', [
        'ds_loaisanpham' => $dataLoaisanpham,
        'ds_nhacungcap' => $dataNhacungcap,
        'ds_khuyenmai' => $dataKhuyenmai,
    ]);
?>