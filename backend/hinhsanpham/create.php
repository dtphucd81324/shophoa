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
            'sp_tomtat' => $sp_tomtat
        );
    }
        //Khi bấm nút Đăng ký thực thi câu lệnh UPDATE
        if(isset($_POST['btnThem'])){
            $sp_ma = $_POST['sp_ma'];

            //nếu người dùng có chọn file để Upload
            if(isset($_FILES['hsp_tentaptin'])){
                $upload_dir = "./../../assets/uploads/";

                // Đối với mỗi file, sẽ có các thuộc tính như sau:
                // $_FILES['hsp_tentaptin']['name']     : Tên của file chúng ta upload
                // $_FILES['hsp_tentaptin']['type']     : Kiểu file mà chúng ta upload (hình ảnh, word, excel, pdf, txt, ...)
                // $_FILES['hsp_tentaptin']['tmp_name'] : Đường dẫn đến file tạm trên web server
                // $_FILES['hsp_tentaptin']['error']    : Trạng thái của file chúng ta upload, 0 => không có lỗi
                // $_FILES['hsp_tentaptin']['size']     : Kích thước của file chúng ta upload
                
                //file upload bị lỗi thì error > 0
                if($_FILES['hsp_tentaptin']['error'] > 0){
                    echo 'File upload bị lỗi'; die;
                }
                else{
                    //tiến hành di chuyển file từ thư mục tạm trên server vào thư mục chính của chúng ta
                    $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                    move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir.$hsp_tentaptin);
                    echo 'File Uploaded';
                }

                //lệnh insert
                $sql = "INSERT INTO `hinhsanpham` (hsp_tentaptin, sp_ma) VALUES ('$hsp_tentaptin', $sp_ma);";

                //thực thi
                mysqli_query($conn, $sql);

                //đóng kết nối
                mysqli_close($conn);

                header('location: index.php');
            }
        }
    echo $twig->render('backend/hinhsanpham/create.html.twig', ['ds_sanpham' => $dataSanpham]);
?>