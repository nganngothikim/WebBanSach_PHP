<?php
require 'inc/init.php';
if (isset($_SESSION['log_detail'])) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	 if($_SESSION['log_detail'][1] == "admin")
    {
        header('Location: admin/index_ad.php');

    }
    else
    {
        header('Location: khachhang/index_kh.php');
    }
}
else
{
   
    header('Location: khachhang/index_kh.php');
}
?>