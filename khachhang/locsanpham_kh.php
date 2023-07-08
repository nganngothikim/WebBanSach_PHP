<?php
$title = 'Home page';

require '../inc/init.php';
require '../class/Database.php';
require '../class/SanPham.php';

require '../class/Loai.php';
require '../class/Pro_Cat.php';
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
$loai = Loai::getAll($pdo);
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


if (isset($_GET['page'])) {
    $count = count($data);
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

if (isset($_GET['action']) && isset($_GET['proid'])) {
        $action = $_GET['action'] ?? '';
        $proid = $_GET['proid'];
        if ($action == 'addcart' && $proid) {
            $proidCol = array_column($_SESSION['cart'], 'proid');
            if (in_array($proid, $proidCol)) {
                    $key = array_search($proid, $proidCol); 
                    // Cập nhật lại giá trị qty cho phần tử này
                    $_SESSION['cart'][$key]['qty'] += 1;
            }
            else{
                $item = ['username' => $_SESSION['log_detail'][0],'proid' => $proid, 'qty' => 1];
                $_SESSION['cart'][] = $item;
            }
            var_dump($_SESSION['cart']);          
        }
    }


?>
<?php require '../inc/header_kh.php';?>

<div class="row p-2">
    <div class="col-10 p-1">
        <h2 class="text-center">Danh sách sản phẩm</h2>
        <div class="row">
            <?php foreach ($data as $sanpham): ?>
            <div class="col-3" style="font-size: 16px;">
                <div class="card m-1 text-center" style="width: 14rem;">
                    <img src="../img/<?php echo $sanpham->hinhanh ?>" class="card-img-top w-100" alt="">
                    <div class="card-body">
                        <a class="card-text"
                            href="chitietsanpham_kh.php?id=<?= $sanpham->masp ?>"><?php echo SanPham::truncate($sanpham->tensp, 60) ?></a>
                        <p class="card-text price" style="color: chocolate;">
                            <?= number_format($sanpham->gia, 0, ',', '.') ?> VNĐ</p>
                        <a href="index_kh.php?action=addcart&proid=<?=$sanpham->masp?>" class="btn"
                            style="background-color: cyan;">Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-2">
        <ul style="list-style: none;" class="navbar-nav">
            <li class="p-2" style="background-color:cyan; color: black;" class="p-2">SẢN PHẨM THEO LOẠI</li>
            <?php foreach ($loai as $item): ?>
            <li class="p-2">
                <a class="nav-item" href="#" style="text-decoration: none"><?php echo $item->tenloai ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
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