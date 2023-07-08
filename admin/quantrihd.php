<?php
$title = 'Home page';

require '../inc/init.php';
require '../class/Database.php';
require '../class/SanPham.php';
require '../class/HoaDon.php';
require '../class/ChiTietHoaDon.php';
require '../class/Loai.php';
require '../class/Pro_Cat.php';
$db = new Database();
$pdo = $db->getConnect();
$hoadon = HoaDon::getAll($pdo);
$cthoadon = ChiTietHoaDon::getAll($pdo);



?>
<?php require '../inc/header_ad.php';?>
<div class="p-1 container-fluid">
<table class="table table-bordered">
    <tr>
        <th>Mã Hóa Đơn</th>
        <th>Username</th>
        <th>Ngày Thanh Toán</th>
        <th>Thành Tiền</th>
        <th>Mã SP</th>
        <th>Số Lượng</th>
    </tr>
    <?php 
        foreach ($hoadon as $hd) {
            foreach ($cthoadon as $cthd) {
                if ($hd->mahd == $cthd->mahd) { ?>
                    <tr>
                        <td><?php echo $hd->mahd; ?></td>
                        <td><?php echo $hd->username; ?></td>
                        <td><?php echo $hd->ngaythanhtoan; ?></td>
                        <td><?php echo $hd->thanhtien; ?> đ</td>
                        <td><?php echo $cthd->masp; ?></td>
                        <td><?php echo $cthd->soluong; ?></td>
                    </tr>
        <?php   }
            }
        }
    ?>
</table>

</div>
<?php require '../inc/footer.php'; ?>