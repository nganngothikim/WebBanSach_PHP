<!DOCTYPE html>
<?php require 'init.php';
// if (!isset($_SESSION['log_detail']))
// {
//     echo"khong co";
// }else{
//     var_dump($_SESSION['log_detail']);
// }

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title><?= $title ?? 'No title' ?></title>
</head>
<body>
    <nav class="navbar navbar-expand" style="background-color: cyan;">
        <div class="container">
            <a class="navbar-brand" href="../khachhang/index_kh.php">Trang Chủ</a>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <?php if (!isset($_SESSION['log_detail'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../login.php">Đăng nhập</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">Đăng xuất</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <form method="post" action="../khachhang/locsanpham_kh.php" enctype="multipart/form-data">
                            <div class="input-group">
                                <input type="search" name="timkiem" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <button type="submit" class="btn btn-outline-primary">search</button>
                            </div>
                        </form>
                    </li>
                </ul>
                <?php if (isset($_SESSION['log_detail'])){?>
                    <div style="margin-left: auto;">
                        <a class="btn btn-outline-success" href="../cart.php">Giỏ hàng
                            <?php if (isset($_SESSION['cart'])) {
                                echo count($_SESSION['cart']);
                            } ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </nav>