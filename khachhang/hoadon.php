<?php
$title = 'Cart page';
require '../inc/init.php';
require '../class/Database.php';
require '../class/Loai.php';
require '../class/SanPham.php';
require '../class/HoaDon.php';
require '../class/ChiTietHoaDon.php';

if ($_GET['action'] == "dathang") {
    $db = new Database();
    $pdo = $db->getConnect();
    $hoadon = new HoaDon();
    $mahd = $hoadon->create($pdo, $_SESSION['log_detail'][0], 0);
    if($mahd != -1)
    {
        var_dump($mahd);
        $giohang = $_SESSION['cart'];
        if (!empty($giohang)) {
            foreach ($giohang as $item) {
                $proid = $item['proid'];
                $qty = $item['qty'];
                $cthoadon = new ChiTietHoaDon();
                $cthoadon->create($pdo, $mahd, $proid, $qty);
            }
        }
        $data = ChiTietHoaDon::getChiTietByMaHD($pdo, $mahd);
    }
    else{
        echo 'Chưa lưu hóa đơn';
    }

}
?>

<?php require '../inc/header_kh.php'; ?>
<div class="container">
    <table class="table my-3">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Số Lượng</th>
            </tr>
        </thead>
        <tbody>
            <?php 	
        $i = 1; $thanhtien = 0;
        if(isset($data)){
            foreach ($data as $sp) {
                $sanpham = SanPham::getOneBymasp($pdo, $sp->masp);
                // Kiểm tra xem sản phẩm có tồn tại trong cơ sở dữ liệu không
                if ($sanpham) {
                    ?>
                <tr class="text-center">
                    <td><?= $i ?></td>
                    <td><?= $sanpham->tensp ?></td>
                    <td><?= number_format($sanpham->gia, 0, ',', '.') ?> VNĐ</td>
                    <td><?= $sp->soluong ?>
                </tr>
                <?php  
                $thanhtien = $thanhtien + ($sp->soluong * $sanpham->gia);
                } else {
                    // Nếu sản phẩm không tồn tại trong cơ sở dữ liệu
                    // Xóa sản phẩm đó khỏi giỏ hàng và hiển thị thông báo lỗi
                    
                    echo '<p>Sản phẩm không tồn tại hoặc đã bị xóa khỏi cơ sở dữ liệu.</p>';
                }
                $i++;
            }
            $hoadon->updateTongTien($pdo, $mahd, $thanhtien);
         }else
         {
             echo 'Chưa có data';
         }
	        ?>
        </tbody>

    </table>
    <h4><b style="margin-left: auto;">TỔNG TIỀN: <?= number_format($thanhtien, 0, ',', '.')?>VNĐ</b></h4>
</div>

<?php require '../inc/footer.php'; ?>