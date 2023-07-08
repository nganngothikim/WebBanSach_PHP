<?php
$title = 'Login page';
require '../inc/init.php';
require '../class/Auth.php';
require '../class/Loai.php';
$db = new Database();
$pdo = $db->getConnect();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $oldUser = Auth::getOneUser($pdo, $id);
    if ($oldUser) {
        $username = $oldUser['username'];
        $password = $oldUser['password'];
        $role = $oldUser['role'];
    } else {
        echo "Không tìm thấy người dùng !";
    }
} else {
    echo "Không tìm thấy id !";
}


    $usernameErrors ="";
    $passwordErrors ="";
    $error = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["username"]))
        {
            $usernameErrors ="username is required";
        }
        else
        {
            $username = $_POST['username'];  
        }

        if(empty($_POST["password"]))
        {
            $passwordErrors ="password is required";
        }
        else
        {
            $password = $_POST['password'];
        }
        if (isset($_POST['role'])) {
            $role = $_POST['role'];
        }
        if($passwordErrors=="" && $usernameErrors=="")
        {
            $error = Auth::updateUser($pdo, $username, $password, $role);
        }

    }
?>

<?php require '../inc/header_ad.php'; ?>

<div class="container text-center d-flex align-items-center min-vh-300">
    <br />
    <div class="pt-5 card mx-auto py-5" style="width: 25rem;">
        <h2>Thêm Người Dùng</h2>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($username) ? $username : ''; ?>"><span
            class="text-danger fw-bold"><?= $usernameErrors ?></span>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password"><span
            class="text-danger fw-bold"><?= $passwordErrors ?></span>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select">
                        <?php if($role == "user"){?>
                            <option value="user" selected>user</option>
                            <option value="admin">admin</option>
                        <?php }else{?>
                            <option value="user" >user</option>
                            <option value="admin" selected>admin</option>
                        <?php }?>

                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
        </div>
        <?php if ($error): ?>
        <div class="card-footer">
            <p class="text-danger"><?= $error?></p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require '../inc/footer.php'; ?>