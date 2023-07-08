<?php
$title = 'New Product';
require '../class/Database.php';
require '../class/SanPham.php';
require '../class/Loai.php';
require '../class/Pro_Cat.php';
$db = new Database();
$pdo = $db->getConnect();
$data = Loai::getAll($pdo);


$error = '';

$tensp = '';
$mota = '';
$gia = '';
$hinhanh = '';


$tenspErrors = '';
$motaErrors = '';
$giaErrors = '';
$hinhanhErrors = '';
$selectErrors = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tensp = $_POST['tensp'];
    $mota = $_POST['mota'];
    $gia = $_POST['gia'];

    if (empty($tensp)) {
        $tenspErrors = 'tensp is required';
    }

    if (empty($mota)) {
        $motaErrors = 'mota is required';
    }

    if (empty($gia)) {
        $giaErrors = 'gia is required';
    } elseif ($gia % 1000 != 0) {
        $giaErrors = 'gia must be devisible by 1000.';
    }


    if (empty($_FILES['file'])) {
        $hinhanhErrors = 'Inval id upload';
        header("Location: them-sanpham.php");
    }
    else{

        try {
        
            switch ($_FILES['file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $hinhanhErrors = 'No file uploaded.';
                default:
                $hinhanhErrors = 'An error occured';
            }

            if ($_FILES['file']['size'] > 1000000) {
                $hinhanhErrors = 'File too large.';
            }
            $mime_types = ['image/gif', 'image/jpeg', 'image/png'];
            $file_info = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($file_info, $_FILES['file']['tmp_name']);
            if (!in_array($mime_type, $mime_types)) {
                $hinhanhErrors = 'Invalid file type.';
            }

            $pathinfo = pathinfo($_FILES['file']['name']);
            $ftensp = 'image';
            $extension = $pathinfo['extension'];

            $dest = $ftensp . '.' . $extension;
            $i = 1;
            while (file_exists('img/' . $dest)){
                $dest = $ftensp . "-$i" .'.' . $extension;
                $i++;
            }

            // Write file
            if (move_uploaded_file($_FILES['file']['tmp_name'], '../img/' . $dest)) {
                $hinhanh = $dest;
            } else {
                $hinhanhErrors = 'Unable to move file';
            }

        } catch (Exception $e) {
            $hinhanhErrors = $e->getMessage();
        }          
}

    if (isset($_POST['mySelect'])) {
        $selectedValue = $_POST['mySelect'];
    }
    else
    {
        $selectErrors = 'No selction';
    }
    // No errors ???
    if (!$tenspErrors && !$motaErrors && !$giaErrors && !$hinhanhErrors && !$selectErrors) {
        $sanpham = new SanPham();
        $sanpham->tensp = $tensp;
        $sanpham->mota = $mota;
        $sanpham->gia = $gia;
        $sanpham->hinhanh = $hinhanh;
        $sanpham->maloai = $selectedValue;
        if ($sanpham->create($pdo)) {
            header("Location: index_ad.php");
            exit;
        }
        else {
            $hinhanhErrors = 'Unable to save product.';
        }
    }
}
?>

<?php require '../inc/header_ad.php'; ?>

<?php if (!$error) : ?>

<h2 class="text-center pt-2">Thêm sản phẩm mới</h2>
<form method="post" class="w-50 m-auto pb-2" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="tensp" class="form-label">Tên Sản Phẩm (*)</label>
        <input class="form-control" id="tensp" name="tensp" value="<?= $tensp ?>" /> <span
            class="text-danger fw-bold"><?= $tenspErrors ?></span>
    </div>
    <div class="mb-3">
        <label for="mota" class="form-label">Mô tả Sản Phẩm (*)</label>
        <textarea class="form-control" id="mota" name="mota" rows="4"><?= $mota ?></textarea> <span
            class="text-danger fw-bold"><?= $motaErrors ?></span>
    </div>
    <div class="mb-3">
        <label for="gia" class="form-label">Giá Bán (*)</label>
        <input class="form-control" id="gia" name="gia" type="number" value="<?= $gia ?>" /> <span
            class="text-danger fw-bold"><?= $giaErrors ?></span>
    </div>
    <div class="mb-3 ">
        <label for="mySelect" class="form-label">Loại Sản Phẩm (*)</label><br />
        <select id="mySelect" name="mySelect" class="form-select">
            <?php foreach ($data as $loai): ?>
                <option value=<?php echo $loai->maloai ?>><?php echo $loai->tenloai ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">File Hình Ảnh</label>
        <input class="form-control" id="file" type="file" name="file" /><span
            class="text-danger fw-bold"><?= $hinhanhErrors ?></span>
    </div>
    <div style="text-align: center;">
        <button type="submit" class="btn" style="background-color: cyan; ">Thêm Sản Phẩm</button>
    </div>
</form>

<?php else: ?>

<h2 class="text-center text-danger"><?= $error ?></h2>

<?php endif; ?>

<?php require '../inc/footer.php'; ?>