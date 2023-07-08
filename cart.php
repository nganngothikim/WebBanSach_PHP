<?php
$title = 'Cart page';
// require 'class/Cart.php';
require 'class/Database.php';
require 'class/Loai.php';
require 'class/SanPham.php';
require 'inc/init.php';
$db = new Database();
$pdo = $db->getConnect();


    if (isset($_GET['action']) && isset($_GET['proid'])) {//kiểm tra có get được giá trị khi thực hiện
        $action = $_GET['action'] ?? '';//nếu ko lấy đc get thì set rỗng
        $proid = $_GET['proid'];
    
        if ($action == 'delete' && $proid) {
            $proidCol = array_column($_SESSION['cart'], 'proid');
            if (in_array($proid, $proidCol)) {
                $key = array_search($proid, $proidCol); 
                unset($_SESSION['cart'][$key]);
            }
            header("Location: cart.php");//làm mới trang
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['qty']) && isset($_POST['proid']) && isset($_POST['action'])){
            $action = $_POST['action'] ?? '';//nếu ko lấy đc get thì set rỗng
            $proid = $_POST['proid'];
            $qty = $_POST['qty'];
            if ($action == 'update' && isset($proid) && isset($qty)) {
                $_SESSION["cart"][$proid]['qty'] = $qty;
                header("Location: cart.php");//làm mới trang
                echo $qty;
            }
        }

        if ($_POST['action'] == 'empty') {
            unset($_SESSION['cart']);
            header("Location: cart.php");
        }
    }

?>

<?php require 'inc/header_kh.php'; ?>
<div class="container">
    <table class="table my-3">
        <form method="post">
            <button class="btn btn-danger mt-2" name="action" value="empty" type="submit">Xóa giỏ hàng trống</button>
        </form>
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 

	if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
		$i = 1; 
		$total = 0;
		foreach ($_SESSION['cart'] as $key => $item) {
            if ($key == 'proid'){
                $sanpham = SanPham::getOneBymasp($pdo, $item);
            }
            // Kiểm tra xem sản phẩm có tồn tại trong cơ sở dữ liệu không
            if ($sanpham) {
                ?>
                <tr class="text-center">
                    <form method="post">
                        <td><?= $i ?></td>
                        <td><?= $sanpham->tensp ?></td>
                        <td><?= number_format($sanpham->gia, 0, ',', '.') ?> VNĐ</td>
                        <td>
                            <input type="number" value="<?= $item['qty'] ?>" name="qty" min="1" style="width: 35px;" />
                            <span><button class="btn btn-warning" name="action" value="update" type="submit">Update</button></span>
                            <input type="hidden" name="proid" value="<?= $item['proid'] ?>">
                        </td>      
                    </form>
                    <td><a href="cart.php?action=delete&proid=<?= $item['proid'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                </tr>
            <?php  
                $i++; 
                $total += $sanpham->gia * $item['qty']; 
            } else {
                // Nếu sản phẩm không tồn tại trong cơ sở dữ liệu
                // Xóa sản phẩm đó khỏi giỏ hàng và hiển thị thông báo lỗi
                unset($_SESSION['cart'][$key]); 
                echo '<p>Sản phẩm không tồn tại hoặc đã bị xóa khỏi cơ sở dữ liệu.</p>';
            }
        }
        
	} else {
		echo '<h2 class="text-center">Giỏ hàng của bạn đang trống!</h2>';
	}
	?>
            <?php if(isset($total)):?>
            <tr>
                <td colspan="5" class="text-center">
                    <h4>Tổng Tiền: <?= number_format($total, 0, ',', '.') ?> VNĐ</h4>
                </td>
            </tr>
            <?php endif;?>
        </tbody>

    </table>
    <div style="margin: auto;">
        <a href="khachhang/hoadon.php?action=dathang" class="btn" style="background-color: cyan ;">Đặt Hàng</a>
    </div>
    <br/>
</div>

<?php require 'inc/footer.php'; ?>