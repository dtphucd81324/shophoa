<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form Đăng ký</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href = "style.css" type = "text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<?php
    include_once('dbconnect.php');
    // include 'sendMailPHP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once "PHPMailer/src/PHPMailer.php";
	require_once "PHPMailer/src/SMTP.php";
    require_once "PHPMailer/src/Exception.php";
  
    if(isset($_POST['sbDangky'])){
        $tendangnhap = $_POST['txtTentk'];
        $matkhau = $_POST['txtMatkhau'];
        $hoten = $_POST['txtName'];
        $email = $_POST['txtemail'];
        $diachi = $_POST['txtDiachi'];
        $dienthoai = $_POST['txtDienthoai'];
        $cmnd = $_POST['txtcmnd'];
        if(isset($_POST['rdSex'])){
            $gioitinh = $_POST['rdSex'];
        }
        $ngaysinh = $_POST['slDay'];
        $thangsinh = $_POST['slMonth'];
        $namsinh = $_POST['slYear'];
        $makichhoat = sha1(time());
        $trangthai = 0;
        $quantri = 0;
        $loi = "";

        if($_POST['txtTentk']=="" || $_POST['txtMatkhau']=="" || $_POST['txtNhaplai']==""
        || $_POST['txtName']==""|| $_POST['txtemail']=="" || $_POST['txtDiachi']=="" || !isset($gioitinh)){
            $loi .="<li>Vui lòng nhập đầy đủ thông tin *</li>";
        }
        if($_POST['txtMatkhau'] != $_POST['txtNhaplai']){
            $loi .="<li>Hai mật khẩu phải trùng nhau.</li>";
        }
        if(strlen($_POST['txtMatkhau']) <=5){
            $loi .="<li>Độ dài mật khẩu phải hơn 5 ký tự.</li>";
        }
        if(strpos($_POST['txtemail'], "@") == false){
            $loi .="<li>Địa chỉ email không hợp lệ.</li>";
        }
        if($_POST['slYear'] == 0){
            $loi .="<li>Chưa chọn năm sinh.</li>";
        }
        if($loi!= ""){
            echo "<ul> class = 'cssLoi'".$loi."</ul>";
        }
        else{
            
            $sql = "INSERT INTO khachhang (kh_tendangnhap, kh_matkhau, kh_ten, kh_gioitinh, kh_diachi, 
            kh_dienthoai, kh_email, kh_ngaysinh, kh_thangsinh, kh_namsinh, kh_cmnd, kh_makichhoat, kh_trangthai, kh_quantri)
            VALUES ('$tendangnhap', '".$matkhau."', '$hoten', '$gioitinh', '$diachi', '$dienthoai', '$email', 
            $ngaysinh, $thangsinh, $namsinh, '$cmnd', '$makichhoat', '$trangthai', $quantri)";
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
            
            $mail = new PHPMailer(true);
            try{
                $mail->IsSMTP(); //Thiet lap mailer de su dung SMTP
                //$mail->SMTPDebug = 2;
                $mail->SMTPAuth = true; // Bat chung thuc SMTP 
                $mail->SMTPSecure = "tsl";
                $mail->Host = "smtp.gmail.com"; // Chi dinh Server chinh va Server phu
                $mail->Port = 587; // Thiet lap cong de su dung
                $mail->Username = 'yanki060595@gmail.com'; // username (Dia chi mail) cua nguoi gui 
                $mail->Password = 'oxrkkjimykybhqve';// Password cua nguoi gui
                $mail->CharSet = 'UTF-8';
                
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'veryfy_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $mail->setFrom('yanki060595@gmail.com','Test Mail');
                $mail->addAddress('yanki060595@gmail.com');
                $mail->addReplyTo('yanki060595@gmail.com', 'Test Mail');

                $mail->isHTML(true);
                $mail->Subject = 'Thông báo đăng ký thành công tài khoản';
                $mail->Body = <<<EOT
                Cám ơn bạn đã tin tưởng Website của chúng tôi! <b>Congratulation</b>.
                Vui lòng click vào liên kết sau để kích hoạt tài khoản!
                <a href="http://localhost:8888/shop/kichhoattaikhoan.php?kh_tendangnhap=$tendangnhap&kh_makichhoat=$makichhoat">Kích hoạt tài khoản</a>
EOT;

                $mail->send();
            }catch(Exception $e){
                echo 'Lỗi khi gởi mail', $mail->ErrorInfo;
            }
		header("location:dangky-success.php?kh_tendangnhap=$tendangnhap");
        }             
    }
	
?>
<body class="app flex-row align-items-center">
    <div class = "container">
        <h2 class = "Dangky">Đăng ký thành viên</h2>
        <form name = "frmDangky" id = "frmDangky" class = "form-horizontal" action = "" method = "POST">
            <div class = "form-group">
                <label class = "control-label col-sm-2" for = "lblTentk">Tên tài khoản(*): </label>
                <div class = "col-sm-10">
                    <input type = "text" name = "txtTentk" id = "txtTentk" class = "form-control" placeholder = "Tên tài khoản" value = "<?php if(isset($tendangnhap)) echo $tendangnhap; ?>" />
                </div>
            </div>
            <div class = "form-group">
                <label for = "" class = "control-label col-sm-2">Mật khẩu(*):</label>
                <div class = "col-sm-10">
                    <input type = "password" name = "txtMatkhau" id = "txtMatkhau" class = "form-control" placeholder = "Mật khẩu" value = "" />
                </div>  
                </div>
            <div class = "form-group">
                <label for = "" class = "control-label col-sm-2">Nhập lại mật khẩu(*): </label>
                <div class = "col-sm-10">
                    <input type = "password" name = "txtNhaplai" id = "txtNhaplai" class = "form-control" placeholder = "Nhập lại mật khẩu" value = "" />
                </div>
            </div>
            <div class = "form-group">
                <label for = "lblName" class = "control-label col-sm-2">Họ tên(*): </label>
                <div class = "col-sm-10">
                    <input type = "text" name = "txtName" id = "txtName" class = "form-control" placeholder= "Nhập họ tên" value = "<?php if(isset($hoten)) echo $hoten; ?>" />
                </div>
            </div>
            <div class = "form-group">
                <label for = "lblemail" class = "control-label col-sm-2">Email(*): </label>
                <div class = "col-sm-10">
                    <input type = "text" name = "txtemail" id = "txtemail" class = "form-control" placeholder = "Email" value = "<?php if(isset($email)) echo $email; ?>" />
                </div>
            </div>
            <div class = "form-group">
                <label for = "lblDiachi" class = "control-label col-sm-2">Địa chỉ(*): </label>
                <div class = "col-sm-10">
                    <input type = "text" name = "txtDiachi" id = "txtDiachi" class = "form-control" placeholder = "Địa chỉ" value = "<?php if(isset($diachi)) echo $diachi; ?>" />
                </div>
            </div>
            <div class = "form-group">
                <label for = "lblDienthoai" class = "control-label col-sm-2">Điện thoại(*): </label>
                <div class = "col-sm-10">
                    <input type = "text" name = "txtDienthoai" id = "txtDienthoai" class = "from-control" placeholder = "Điện thoại" value = "<?php if(isset($dienthoai)) echo $dienthoai; ?>" />
                </div>
            </div>
            <div class = "form-group">
                <label class = "control-label col-sm-2" for = "lblcmnd">CMND(*): </label>
                <div class = "col-sm-10">
                    <input type = "text" name = "txtcmnd" id = "txtcmnd" class = "form-control" placeholder = "Chứng minh nhân dân" value = "<?php if(isset($cmnd)) echo $cmnd; ?>" />
                </div>
            </div>
            <div class = "form-group">
                <label for = "lblSex" class = "control-label col-sm-2">Giới tính(*): </label>
                <div class = "col-sm-10">
                    <label class = "radio-inline">
                        <input type = "radio" name = "rdSex" id = "rdSex" value = "0" />
                        <?php if(isset($gioitinh) && $gioitinh == "0"){ echo "checked"; } ?>
                        Nam</label>
                    <label class = "radio-inline">
                        <input type = "radio" name = "rdSex" id = "rdSex" value = "1" />
                        <?php if(isset($gioitinh) && $gioitinh == "1"){ echo "checked"; } ?>
                        Nữ</label>
                </div>
            </div>
            <div class = "form_group">
                <label for = "lblDay" class = "control-label col-sm-2">Ngày sinh(*): </label>
                <div class = "col-sm-10 input-group">
                    <span class = "input-group-btn">
                        <select class = "form-control" name = "slDay" id = "slDay">
                            <option value = "0">Chọn ngày</option>
                            <?php
                                for($i = 1; $i <= 31; $i++){
                                    if($i == $ngaysinh){
                                        echo "<option value = '".$i."' selected=\"selected\">".$i."</option>"; 
                                    }
                                    else{
                                        echo "<option value = '".$i."'>".$i."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </span>
                    <span class = "input-group-btn">
                        <select class = "form-control" name = "slMonth" id = "slMonth">
                            <option value = "0">Chọn tháng</option>
                            <?php
                                for($i = 1; $i <= 12; $i++){
                                    if($i == $thangsinh){
                                        echo "<option value = '".$i."' selected=\"selected\">".$i."</option>"; 
                                    }
                                    else{
                                        echo "<option value = '".$i."'>".$i."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </span>
                    <span class = "input-group-btn">
                        <select class = "form-control" name = "slYear" id = "slYear">
                            <option value = "0">Chọn năm</option>
                            <?php
                                for($i = 1900; $i <= 2010; $i++){
                                    if($i == $ngaysinh){
                                        echo "<option value = '".$i."' selected=\"selected\">".$i."</option>"; 
                                    }
                                    else{
                                        echo "<option value = '".$i."'>".$i."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </span>
                </div>
            </div>
            
            <!-- <div class = "form-group">
                <label for = "lblCaptcha" class = "control-label col-sm-2">Mã an toàn(*): </label>
                <div class = "col-sm-10">
                    <div class = "g-recaptcha" data-sitekey = ""></div>
                </div>
            </div> -->
            <div class = "form-group">
                <div class="row">
                    <div class = "col-6 ">
                        <input type = "submit" name = "sbDangky" id = "sbDangky" class = "btn btn-primary" value = "Đăng ký"  />
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>