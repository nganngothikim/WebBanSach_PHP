<?php
$title = 'Product page';
if (! isset($_GET["id"])) {
    die("Cần cung cấp id sản phẩm !!!");
}

$id = $_GET["id"];
require '../class/Database.php';
require '../class/Auth.php';
require '../inc/init.php';
require '../class/Loai.php';
//Không require database vì đã có bên class Auth
require '../class/SanPham.php';

$db = new Database();
$pdo = $db->getConnect();
$sanham = SanPham::getOneBymasp($pdo, $id);

if (!$sanham) {
    die("id không hợp lệ.");
}
?>

<?php require '../inc/header_ad.php'; ?>

<h2>Thông tin sản phẩm</h2>
<table class="table table-success">
    <tr>
        <td class="table-dark" style="width: 10%">Mã SP</td>
        <td><?= $sanham->masp ?></td>
    </tr>
    <tr>
        <td class="table-dark">Tên SP</td>
        <td><?= $sanham->tensp ?></td>
    </tr>
    <tr>
        <td class="table-dark">Mô tả</td>
        <td><?= $sanham->mota ?></td>
    </tr>
    <tr>
        <td class="table-dark">Hình ảnh</td>
        <td><img src="../img/<?= $sanham->hinhanh ?>" style="width: 20%;"></img></td>
    </tr>
    <tr>
        <td class="table-dark">Giá</td>
        <td><?= number_format($sanham->gia, 0, ',', '.') ?> VNĐ</td>
    </tr>
    <?php if( isset($_SESSION['log_detail']) && $_SESSION['log_detail'][1] == "admin"):?>
        <tr>
            <td colspan="2" style="padding-left: 10%">
                <a class="btn btn-info" href="sua-sanpham.php?id=<?= $sanham->masp ?>">Edit</a> 
            </td>
        </tr>
    <?php endif;?>
</table>

<?php require '../inc/footer.php'; ?>