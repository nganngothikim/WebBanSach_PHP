<?php
require dirname(__FILE__) .'\Database.php';
class Auth 
{
    public $username;
    public $password;
    public $role;
    public $pdo;

    public function __construct() {
        $data = new Database();
        $this->pdo = $data->getConnect();
    }
    public static function getAllUsers($pdo) {//lấy danh sách user
        $sql = "SELECT * FROM user";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Auth');
            return $stmt->fetchAll();
        }
    }


    public static function getOneUser($pdo, $username) {//lấy role user đang đăng nhập
        $sql = "SELECT * FROM user WHERE username = :username" ;
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }

    public function deleteUser($pdo, $username) {//lấy role user đang đăng nhập
        $sql = "DELETE FROM user WHERE username = :username" ;
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            header('Location: quantringuoidung.php');
            exit;
        }
    }

    public static function updateUser ($pdo, $username, $password, $role) {
        $kt = "SELECT * FROM user WHERE username = :username" ;
        $stmt = $pdo->prepare($kt);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            // Kiểm tra xem username đã tồn tại hay chưa
            if ($stmt->rowCount() > 0) {
              // username đã tồn tại, trả về thông báo lỗi
              return 'Người dùng đã tồn tại';
            } else {
                $sql = "UPDATE user SET role=:role, password=:password WHERE username=:username";
                $stmt = $pdo->prepare($sql);
                $hashpass = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bindParam(':password', $hashpass, PDO::PARAM_STR);
                $stmt->bindParam(':role', $role, PDO::PARAM_STR);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                if($stmt->execute())
                {
                    header('Location: quantringuoidung.php');
                    exit();                  
                }
                else
                {
                    return false;

                }
            }

    }
    }

    public static function register ($pdo, $username, $password) {
        $kt = "SELECT * FROM user WHERE username = :username" ;
        $stmt = $pdo->prepare($kt);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            // Kiểm tra xem username đã tồn tại hay chưa
            if ($stmt->rowCount() > 0) {
              // username đã tồn tại, trả về thông báo lỗi
              return 'Người dùng đã tồn tại';
            } else {
                $sql = "INSERT INTO user (password, role, username) VALUES (:password, :role, :username)";
                $stmt = $pdo->prepare($sql);
                $hashpass = password_hash($password, PASSWORD_DEFAULT);
                $role = 'user';
                $stmt->bindParam(':password', $hashpass, PDO::PARAM_STR);
                $stmt->bindParam(':role', $role, PDO::PARAM_STR);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                if($stmt->execute())
                {
                    header('Location: login.php');
                    exit();                  
                }
                else
                {
                    return false;

                }
            }

    }
    }
    
    public static function addUser ($pdo, $username, $password, $role) {
        $kt = "SELECT * FROM user WHERE username = :username" ;
        $stmt = $pdo->prepare($kt);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            // Kiểm tra xem username đã tồn tại hay chưa
            if ($stmt->rowCount() > 0) {
              // username đã tồn tại, trả về thông báo lỗi
              return 'Người dùng đã tồn tại';
            } else {
                $sql = "INSERT INTO user (password, role, username) VALUES (:password, :role, :username)";
                $stmt = $pdo->prepare($sql);
                $hashpass = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bindParam(':password', $hashpass, PDO::PARAM_STR);
                $stmt->bindParam(':role', $role, PDO::PARAM_STR);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                if($stmt->execute())
                {
                    header('Location: quantringuoidung.php');
                    exit();                  
                }
                else
                {
                    return false;

                }
            }

    }
    }

    public static function login ($pdo, $username, $password) {
        $sql = "SELECT * FROM user WHERE username=:username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            
            if($row)
            {
                if ($row->username == $username  && password_verify($password, $row->password)) {//so sánh pass đã mã hóa
                    $_SESSION['log_detail'] = [$username, $row->role];//lưu name và role dưới dạng mảng 
                    header('Location: index.php');
                    exit();
                }
            }
            return 'Login Fail';
        }
        else
        {
            return 'Login Fail';
        }
    }

    public static function logout() {
        unset($_SESSION['log_detail']);

        header('location: index.php');
        exit;
    }

    public static function requireLogin() {
        if (!isset($_SESSION['log_detail'])) {
            return 'Bạn không được phép truy cập';
        }
        return '';
    }
}