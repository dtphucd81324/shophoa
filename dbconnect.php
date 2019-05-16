<?php 
    $conn = mysqli_connect('localhost','root','','shophoa') or die("Không thể kết nối cơ sở dữ liệu".mysqli_connect($conn));
    $conn->query("SET NAME 'utf8'");
    $conn->query("SET CHARACTER SET utf8");
    $conn->query("SET SESSION collation_connection = 'utf8_unicode_i'");
	
	//Start session
	session_start();
?>