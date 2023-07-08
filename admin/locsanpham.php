<?php
$title = 'Home page';

require '../inc/init.php';
require '../class/Database.php';
require '../class/SanPham.php';
// require 'class/Cart.php';
require '../class/Loai.php';
require '../class/Pro_Cat.php';
// $cart = new Cart();
// $procat = new Pro_Cat();

$maloai ='';
$timkiem='';

if (isset($_GET['id'])) {
    $maloai = $_GET['id'];
} else {
    // echo "Không tìm thấy giá trị truyền vào";
}

if (isset($_POST['timkiem'])) {
    $timkiem = $_POST['timkiem'];
} else {
    // echo "Không tìm thấy giá trị truyền vào";
}
$db = new Database();
$pdo = $db->getConnect();
$pagecurrent = 1;
$sanpham_per_page = 4;
$page = $_GET['page'] ?? 1;
$limit = $sanpham_per_page;
$offset = ($page - 1) * $sanpham_per_page; 
if($maloai != '')
{
    $data = SanPham::getDSSanPhamByMaLoai($pdo, $maloai, $limit, $offset);
}
if ($timkiem!='')
{
    $data = SanPham::timKiemSanPham($pdo, $timkiem, $limit, $offset);
}

$count = count($data);
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($count == $sanpham_per_page) {
        $offset = ($page - 1) * $sanpham_per_page;
        if(isset($_GET['id']))
        {
            $data = SanPham::getDSSanPhamByMaLoai($pdo, $maloai, $limit, $offset);
        }
        if (isset($_GET['timkiem']))
        {
            $data = SanPham::timKiemSanPham($pdo, $timkiem, $limit, $offset);
        }
    }
}


?>
<?php require '../inc/header_ad.php';?>
<div class="p-1">
    <table class="table" style="width: 100%; font-size: 15px;">
        <thead class="table-dark">
            <tr>
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Mô Tả</th>
                <th>Giá</th>
                <th>Hình Ảnh</th>
                <th>Mã Loại</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $sanpham): ?>
            <tr>
                <?php foreach (get_object_vars($sanpham) as $key => $value): ?>
                <?php if ($key == 'gia') : ?>
                <td><?= number_format($value, 0, ',', '.') ?> VNĐ</td>
                <?php elseif ($key == 'tensp'): ?>
                <td><a href="chitietsanpham_ad.php?id=<?= $sanpham->masp ?>"><?= $value ?></a></td>
                <?php elseif($key == 'hinhanh'):?>
                <?php if($value == null):?>
                <td>Chưa có hình</td>
                <?php else:?>
                <td><img style="width: 50%;" src="../img/<?= $value?>" /></td>
                <?php endif; ?>
                <?php else: ?>
                <td><?= $value ?></td>
                <?php endif; ?>
                
                <?php endforeach; ?>
                <td><a class="btn btn-danger" href="xoa-sanpham.php?id=<?= $sanpham->masp ?>">Xóa</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<form method="get" class="d-flex justify-content-center">
    <div class="pagination">
        <button class="page-item" name="page" value="<?= $page - 1 ?>" type="submit"
            <?= $page <= 1 ? 'disabled' : '' ?>>Previous</button>
        <div class="page-item"><?= $page ?></div>
        <button class="page-item" name="page" value="<?= $page + 1 ?>" type="submit"
            <?= count($data) < $sanpham_per_page ? 'disabled' : '' ?>>Next</button>
    </div>
</form>

<?php require '../inc/footer.php'; ?>