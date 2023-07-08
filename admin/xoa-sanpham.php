<?php
require '../class/Database.php';
require '../class/SanPham.php';
require '../class/Loai.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "Không tìm thấy id";
}
$db = new Database();
$pdo = $db->getConnect();
$sanpham = SanPham::getOneBymasp($pdo, $id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($sanpham->removesanpham($pdo, $id)) {
        header('Location: index_ad.php');
        exit;
    }
    else{
        echo "Lỗi, không thể xóa !";
    }
}


?>

<?php require '../inc/header_ad.php'; ?>
<div class="container text-center d-flex align-items-center p-2">
    <form method="post" class="w-50 m-auto card mx-auto" >
        <div class="mb-2">
            <p>Bạn có chắc chắn muốn xóa không?</p>
            <button type="submit" class="btn btn-primary">Yes</button>
            <a class="btn btn-primary" href="index_ad.php">Cancel</a>
        </div>
    </form>
</div>