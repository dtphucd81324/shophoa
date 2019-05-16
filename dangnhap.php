<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng nhập</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href = "style.css" type = "text/css">
    <link rel="stylesheet" href="/shop/vendor/bootstrap/css/bootstrap.min.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   
</head>

<?php
    include_once('dbconnect.php');	

    if(isset($_POST['sbmLogin'])){
        $user = trim($_POST['txtDangnhap']);
        $pass = trim($_POST['txtMatkhau']);

        $loi = "";
        if($user ==""){
            $loi .= "Vui lòng nhập tên đăng nhập!<br/>";
        }
        if($pass ==""){
            $loi .= "Vui lòng nhập mật khẩu!<br/>";
        }
        if($loi !=""){
            echo "<span class=\"cssLoi\">".$loi."</span>";;
        }
        else{
            $user = mysqli_real_escape_string($conn, $user);
            //$pass = md5($pass);
            $sql = "SELECT * FROM khachhang where kh_tendangnhap='$user' AND kh_matkhau='$pass';";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result)>0){
				$data = [];
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
					$data[] = array(
						'kh_tendangnhap' => $row['kh_tendangnhap'],
						'kh_ten' => $row['kh_ten'],
						'kh_trangthai' => $row['kh_trangthai'],
					);
				}
				if($data[0]['kh_trangthai'] != 1){ //chưa kích hoạt tài khoản
					echo '<h1>Tài khoản của bạn chưa được kích hoạt, bạn vui lòng kích hoạt tài khoản của mình!!!</h1>';
				}
				else{//đã kích hoạt
					echo '<b>Đăng nhập thành công!</b>';
					$_SESSION['username'] = $user;
					$_SESSION['kh_trangthai'] = 1; 
				}
                
			}
			else{
				echo 'Đăng nhập thất bại!';
			}
			mysqli_close($conn);
        }	
	}
	if(isset($_SESSION['user'])){
		echo "<h1>Đăng nhập thành công</h1>";
		header('location:trangchu.php');
	}

?>
<body class = "app flex-row align-items-center">
	<form name = "frmDangky" id = "frmDangky" method = "POST" action = "#" class = "form-horizontal">  
		<div class = "container">			
			<div class = "row justify-content-center">
				<div class = "col-md-8">
					<div class = "card-group">
						<div class="card p-4">
							<div class = "card-body">
								<h1>Login</h1>                 
									<p class="text-muted">Sign in to your account</p>
										<div class="input-group mb-3">
										  <div class="input-group-prepend">
											<span class="input-group-text">
												<i class="icon-user"></i>
											</span>
										  </div>
											<input type = "text" name = "txtDangnhap" id = "txtDangnhap" class = "form-control" placeholder = "Tên đăng nhập" value = "" />										
										</div> 
										<div class = "input-group mb-4"> 
											<div class="input-group-prepend">
												<span class="input-group-text">
												  <i class="icon-lock"></i>
												</span>
											 </div>
											<input type = "password" name = "txtMatkhau" id = "txtMatkhau" class = "form-control" placeholder = "Mật khẩu" value = "" />											
										</div>
										<div class="row">
											<div class="col-6">
												<input type = "submit" name = "sbmLogin" id = "sbmLogin" class = "btn btn-primary" value = "Đăng nhập"/>
												<label>
													<input type = "checkbox" name = "chkRemmember" id = "chkRemmember" value = "1" class = "checkbox-inline"/>Ghi nhớ đăng nhập
												</label>
											</div>
											<div class="col-6 text-right">
												<button class="btn btn-link px-0" type="button">Quên mật khẩu</button>
											</div>
										</div>									                       
							</div>
						</div>
					<div class="card text-white bg-primary py-5 d-md-down-none">
						<div class="card-body text-center">
							<div>
								<h2>Đăng ký</h2>
								<p>Bạn có thể nhấn vào nút bên dưới để đăng ký ngay!</p>
								<button type="button" class="btn btn-primary active mt-3" ><a href="dangky.php">Đăng ký ngay</a></button>
							</div>
						</div>
					</div>
					</div>
				</div>	
			</div>
		</div>
	</form>
	<script src="/shop/vendor/jquery/jquery.min.js"></script>
    <script src="/shop/vendor/popperjs/popper.min.js"></script>
    <script src="/shop/vendor/feather/feather.min.js"></script>

    <!-- Custom script - Các file js do mình tự viết -->
    <script src="/shop/vendor/js/app.js"></script>
</body>
</html>
