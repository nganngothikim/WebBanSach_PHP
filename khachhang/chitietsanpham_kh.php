<?php
$title = 'Product page';
if (! isset($_GET["id"])) {
    die("Cần cung cấp id sản phẩm !!!");
}

$id = $_GET["id"];
// require '../class/Auth.php';
require '../class/Database.php';


require '../inc/init.php';
//Không require database vì đã có bên class Auth
require '../class/SanPham.php';

$db = new Database();
$pdo = $db->getConnect();
$sanpham = SanPham::getOneBymasp($pdo, $id);

if (!$sanpham) {
    die("id không hợp lệ.");
}
?>

<?php require '../inc/header_kh.php'; ?>
<h2 class="text-center">Thông tin sản phẩm</h2>
<div class="container d-flex align-items-center" style=" position: relative; border: 1px solid #ddd; border-radius: 10px; height: 400px;">
    <div class="row" style="font-size: 16px;">

        <div class="col-4" style="">
            <img src="../img/<?php echo $sanpham->hinhanh ?>" class="w-100 " style="max-width: 100%; height: auto;">
        </div>
        <div class="col-8">
                <b class="">
                    <?php echo $sanpham->tensp?>
                </b>
                <p class="">
                    <?php echo $sanpham->mota?>
                </p>
                <b style="color: chocolate;"><?= number_format($sanpham->gia, 0, ',', '.') ?> VNĐ</b>

        </div>
    </div>

</div>
<?php require '../inc/footer.php'; ?>