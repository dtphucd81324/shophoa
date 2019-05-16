<?php 
    require_once __DIR__.'/../../bootstrap.php';
    include_once(__DIR__.'/../../dbconnect.php');

    $sql = <<<EOT
    SELECT sp.*
        , lsp.lsp_ten
        , ncc.ncc_ten
        , km.km_ten, km.km_noidung, km.km_tungay, km.km_denngay
    FROM `sanpham` sp
    JOIN `loaisanpham` lsp ON sp.lsp_ma = lsp.lsp_ma
    JOIN `nhacungcap` ncc ON sp.ncc_ma = ncc.ncc_ma
    LEFT JOIN `khuyenmai` km ON sp.km_ma = km.km_ma
    ORDER BY sp.sp_ma DESC
EOT;
    $result = mysqli_query($conn, $sql);

    $data = [];
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $km_tomtat = '';
        if(!empty($row['km_ten'])){
            $km_tomtat = sprintf("Khuyến mãi %s, nội dung: %s, thời gian: %s-%s",
                $row['km_ten'],
                $row['km_noidung'],
                //sử dụng hàm date($format, $timestamp) để chuyển đổi ngày thành định dạng Việt Nam
                // Do hàm date() nhận vào là đối tượng thời gian, chúng ta cần sử dụng hàm strtotime() để chuyển đổi từ chuỗi có định dạng 'yyyy-mm-dd' trong MYSQL thành đối tượng ngày tháng
                date('d/m/Y', strtotime($row['km_tungay'])),
                date('d/m/Y', strtotime($row['km_denngay'])));            
        }
        $data[] = array(
            'sp_ma' => $row['sp_ma'],
            'sp_ten' => $row['sp_ten'],
            'sp_mota' => $row['sp_mota'],
            'sp_gia' => number_format($row['sp_gia'], 2, ".", ",") . ' vnđ',
            'sp_giacu' => number_format($row['sp_giacu'], 2, ".", ",") . ' vnđ',
            'sp_ngaycapnhat' => date('d/m/Y H:i:s', strtotime($row['sp_ngaycapnhat'])),
            'sp_soluong' => number_format($row['sp_soluong'], 0, ".", ","),
            'lsp_ma' => $row['lsp_ma'],
            'ncc_ma' => $row['ncc_ma'],
            'km_ma' => $row['km_ma'],
            //Lấy các cột dữ liệu khác từ liên kết khóa ngoại
            'lsp_ten' => $row['lsp_ten'],
            'ncc_ten' => $row['ncc_ten'],
            'km_tomtat' => $km_tomtat
        );
    }
    echo $twig->render('backend/sanpham/index.html.twig', ['ds_sanpham' => $data]);
    
?>