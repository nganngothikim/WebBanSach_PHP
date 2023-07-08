<?php
    require '../class/Database.php';
    require '../class/SanPham.php';
    require '../class/Loai.php';
    require '../class/Pro_Cat.php';
      $db = new Database();
      $pdo = $db->getConnect();
      $procat = new Pro_Cat();
      $data = Loai::getAll($pdo);

      $sanpham = new SanPham();
      if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $oldProduct = SanPham::getOneBymasp($pdo, $id);//trả về 1 đối tượng product
        } else {
            echo "Không tìm thấy sản phẩm !";
        }

    $tensp = $oldProduct->tensp;//gán giá trị để in lên form edit
    $mota = $oldProduct->mota;
    $gia = $oldProduct->gia;
    $hinhanh = $oldProduct->hinhanh;
    $loai = $oldProduct->maloai;

    $tenspErrors = '';
    $motaErrors = '';
    $giaErrors = '';
    $hinhanhErrors = '';
    $selectErrors = '';
      
if($_SERVER["REQUEST_METHOD"] == "POST")//vallidation giống thêm 1 product
{
    if(empty($_POST["tensp"]))
    {
        $tenspErrors ="Name is required";
    }
    else
    {
        $tensp = $_POST["tensp"];
    }

    if(empty($_POST["mota"]))
    {
        $motaErrors ="Description is required";
    }
    else
    {
        $mota = $_POST["mota"];
    }

    if(empty($_POST["gia"]))
    {
        $giaErrors ="Price is required";
    }
    else 
    {
        $gia = $_POST["gia"];
        if($gia%1000!=0)
        {
            $giaErrors ="Giá phải là bội số của 1000";
        }
    }

//kiểm tra file
    try {
        if (empty($_FILES['file'])) {
            $hinhanhErrors = 'Inval id upload';
        }

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
        if (file_exists('img/'.$oldProduct->hinhanh)) {
            unlink('img/'.$oldProduct->hinhanh);
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





    if(($tenspErrors=="") && ($motaErrors=="") && ($giaErrors=="")&& ($hinhanhErrors==""))//nếu ko lỗi
    {
        if ($sanpham->editsanpham($pdo, $tensp, $mota, $gia, $hinhanh, $id, $loai)) {
            header("Location: chitietsanpham_ad.php?id={$id}");
            exit;
            }
            else {
                $hinhanh = 'Unable to save product.';
            };
        }

    else{
        echo "Edit Product failed";
    }
}
?>





<?php require '../inc/header_ad.php'; ?>

<h2>Thêm sản phẩm mới</h2>
<form method="post" class="w-50 m-auto" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="tensp" class="form-label">Tên Sản Phẩm (*)</label>
        <input class="form-control" id="tensp" name="tensp" value="<?= $tensp ?>" /> <span
            class="text-danger fw-bold"><?= $tenspErrors ?></span>
    </div>
    <div class="mb-3">
        <label for="mota" class="form-label">Mô Tả (*)</label>
        <textarea class="form-control" id="mota" name="mota" rows="4"><?= $mota ?></textarea> <span
            class="text-danger fw-bold"><?= $motaErrors ?></span>
    </div>
    <div class="mb-3">
        <label for="gia" class="form-label">Giá (*)</label>
        <input class="form-control" id="gia" name="gia" type="number" value="<?= $gia ?>" /> <span
            class="text-danger fw-bold"><?= $giaErrors ?></span>
    </div>
    <div class="mb-3 ">
        <label for="mySelect" class="form-label">Loại Sản Phẩm (*)</label><br />
        <select id="mySelect" name="mySelect" class="form-select">
            <?php foreach ($data as $loai): ?>
                <?php if ($oldProduct->maloai == $loai->maloai) : ?>
                    <option value=<?php echo $loai->maloai ?> selected><?php echo $loai->tenloai ?></option>
                <?php else: ?>
                    <option value=<?php echo $loai->maloai ?>><?php echo $loai->tenloai ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Image file</label>
        <img class="form-control" src="../img/<?= $hinhanh ?>" />
        <input class="form-control" id="file" type="file" name="file" /><span
            class="text-danger fw-bold"><?= $hinhanhErrors ?></span>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>


<?php require '../inc/footer.php'; ?>