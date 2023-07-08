<?php
$title = 'Home page';

require '../inc/init.php';
require '../class/Auth.php';
require '../class/Loai.php';
$db = new Database();
$pdo = $db->getConnect();
$users = new Auth();


?>
<?php require '../inc/header_ad.php';?>
<div class="p-1 container-fluid">
<a class="btn btn-primary m-1" href="them-nguoidung.php">Thêm Người Dùng</a>
<table class="table table-bordered">
    <tr>
        <th>Username</th>
        <th>Password</th>
        <th>Role</th>
        <th></th>
    </tr>
    <?php 
        foreach (Auth::getAllUsers($pdo) as $user) { ?>
                    <tr>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user->password; ?></td>
                        <td><?php echo $user->role; ?></td>
                        <td><a class="btn btn-danger" href="xoa-nguoidung.php?id=<?= $user->username ?>">Xóa</a>
                        <span><a class="btn btn-danger" href="sua-nguoidung.php?id=<?= $user->username ?>">Sửa</a></span>
                        </td>
                    </tr>
        <?php   }
    ?>
</table>

</div>
<?php require '../inc/footer.php'; ?>