<html>
<head>
    <meta charset = "utf-8" >
    <title>Kích hoạt Tài khoản</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href = "style.css" type = "text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<?php 
        //require_once __DIR__.'/../../bootstrap.php';

        include_once('dbconnect.php');
        $kh_tendangnhap = $_GET['kh_tendangnhap'];
        $kh_makichhoat = $_GET['kh_makichhoat'];

        //câu lệnh Select
        $sql = "SELECT * FROM `khachhang` WHERE kh_tendangnhap = '$kh_tendangnhap' AND kh_makichhoat = '$kh_makichhoat';";
        $result = mysqli_query($conn, $sql);
        //sử dụng hàm mysqli_num_rows
        if(mysqli_num_rows($result)>0){
            $sqlUpdate = "UPDATE `khachhang` SET kh_trangthai = 1 WHERE kh_tendangnhap = '$kh_tendangnhap';";
            mysqli_query($conn, $sqlUpdate);
            //echo '<h1>Chúc mừng bạn đã kích hoạt tài khoản thành công</h1>';
        }
        else{
            echo 'Kích hoạt tài khoản thất bại';
        }

    ?>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Chúc mừng bạn đã kích hoạt tài khoản thành công!</h1>
            </div>
        </div>
    </div>
</body>
</html>