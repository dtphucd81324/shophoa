<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "utf-8">
        <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>Shop Hoa Tươi</title>
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        
        <!-- Custom CSS -->
        <!-- <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="style.css">-->
        <link rel="stylesheet" href="css/responsive.css"> 
        
        <!-- Tạo menu cap  -->
        <!-- <link href="cssshop/bootstrap.min.css" rel="stylesheet">
        <link href="cssshop/font-awesome.min.css" rel="stylesheet"> -->
        <!-- <link href="css/prettyPhoto.css" rel="stylesheet"> -->
        <!-- <link href="cssshop/price-range.css" rel="stylesheet"> -->
        <!-- <link href="css/animate.css" rel="stylesheet"> -->
        <!-- <link href="cssshop/responsive.css" rel="stylesheet"> -->


        <!-- Database -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    </head>
    <body>
       <header id = "header">
            <div class = "header_top">
                <div class = "container">
                    <div class = "row">
                        <div class = "col-sm-6">
                            <div class = "contactinfo">
                                <ul class = "nav nav-pills">
                                    <li><a href = "#"><i class = "fas fa-phone-square"> +84 939 533 724</i></a></li>
                                    <li><a href = "#"><i class = "fas fa-envelope-square"></i> dtphucd18324@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class = "col-sm-6">
                            <div class = "social-icons pull-right">
                                <ul class = "nav navbar-nav ">
                                    <li class="nav-item"><a href = "#" class="nav-link"><i class = "fab fa-facebook"></i></a></li>
                                    <li class="nav-item"><a href = "#" class="nav-link"><i class = "fab fa-twitter-square"></i></a></li>
                                    <li class="nav-item"><a href = "#" class="nav-link"><i class = "fab fa-linkedin"></i></a></li>
                                    <li class="nav-item"><a href = "#" class="nav-link"><i class = "fab fa-dribbble-square"></i></a></li>
                                    <li class="nav-item"><a href = "#" class="nav-link"><i class = "fab fa-google-plus-square"></i></a></li>
                                </ul>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class = "header-middle" style = "background-color: #069">
                <div class = "container">
                    <div>
                        <div class = "col-sm-4">
                            <div class = "logo pull-left">
                                <a href="trangchu.php" style ="background-color: #069; color: #EEE">Shop Hoa Tươi<img src="images/logo.png" width="80px"></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="#" style="background-color:#069; color:#EEE"><i class="fas fa-user"></i>Tài khoản</a></li>
                                    <li><a href="?khoatrang=giohang" style="background-color:#069; color:#EEE"><i class="fas fa-shopping-cart"></i>Giỏ hàng<span class="badge"></span></a></li>
                                    <li><a href="?khoatrang=capnhatkhachhang" style="background-color:#069; color:#EEE"><i class="fas fa-lock">Chào</i></a></li>
                                    
                                    <?php
                                        if(isset($_SESSION['user'])){ ?>
                                            <li><a href="dangxuat.php" style="background-color:#069; color:#EEE"><i class="fas fa-crosshairs"><?php $_SESSION['user'] = $user; ?>Đăng xuất</i></a></li>
                                    <?php
                                        }
                                        else{
                                    ?>
                                            <li><a href="dangnhap.php" style="background-color:#069; color:#EEE"><i class="fas fa-lock">Đăng nhập</i></a></li>
                                    <?php    
                                        };
                                    ?>                                    
                                    
                                    <li><a href="dangky.php" style="background-color: #069; color:#EEE"><i class="fas fa-star"></i>Đăng ký</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- header middle -->
            <div class="header-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Website Hoa Tươi</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="trangchu.ph">Trang chủ</a></li>
                                    <li><a href="#" id="menu1" data-toggle="dropdown">Giới thiệu<span class="caret"></span></a>
                                        <ul class="dropdown-menu" rol="menu" aria-labelledby="menu1">
                                            <li role="presentation"><a href="#" role="menuitem" tabindex="-1">Lịch sử hình thành</a></li>
                                            <li role="presentation"><a href="#" role="menuitem" tabindex="-1">Hệ thống chi nhánh</a></li>
                                            <li role="presentation"><a href="#" role="menuitem" tabindex="-1">Hình thức thanh toán</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#" id="menu1" data-toggle="dropdown">Quản lý danh mục<span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                            <li role="presentation"><a href="?khoatrang=quanlyloaisanpham" role="menuitem" tabindex="-1">Loại sản phẩm</a></li>
                                            <li role="presentation"><a href="?khoatrang=quanlysanpham" role="menuitem" tabindex="-1">Sản phẩm</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="?khoatrang=giohang">Giỏ hàng</a></li>
                                    <li><a href="?khoatrang=gopy">Góp ý</a></li>
                                    <li><a href="">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" placeholder="Tìm kiếm" class="form-control" >
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- header-bottom -->
       </header> <!-- header-->
    </body>
</html>