<?php
$title = 'Login page';
require '../inc/init.php';
require '../class/Auth.php';

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $pdo = $db->getConnect();
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (isset($_POST['role'])) {
        $role = $_POST['role'];
    }
    $error = Auth::addUser($pdo, $username, $password, $role);

}
?>

<?php require '../inc/header_kh.php'; ?>

<div class="container text-center d-flex align-items-center min-vh-300">
    <br/>
    <div class="pt-5 card mx-auto py-5" style="width: 25rem;">
        <h2>Thêm Người Dùng</h2>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select> 
                </div>  
                <button type="submit" class="btn btn-primary" name="login">Thêm</button>
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