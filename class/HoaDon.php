<?php
class HoaDon
{

    public $mahd;
    public $username;
    public $ngaythanhtoan;
    public $thanhtien;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM hoadon";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'HoaDon');
            return $stmt->fetchAll();
        }
    }

    public function create($pdo, $username, $thanhtien)
    {   
        $ngaythanhtoan = date('Y-m-d'); // Lấy giá trị ngày hiện tại với định dạng Y-m-d
        $sql = "INSERT INTO hoadon (username, ngaythanhtoan, thanhtien) VALUES (:username, :ngaythanhtoan, :thanhtien)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':ngaythanhtoan', $ngaythanhtoan, PDO::PARAM_STR);
        $stmt->bindParam(':thanhtien', $thanhtien, PDO::PARAM_INT);
        if ($stmt->execute()) {
            // Trả về mã hóa đơn vừa thêm thành công
            return $pdo->lastInsertId();
        } else {
            // Nếu không thành công, trả về giá trị âm
            return -1;
        }
    }
    public function updateTongTien($pdo, $mahd, $thanhtien)
    {
        $sql = "UPDATE hoadon SET thanhtien=:thanhtien WHERE mahd=:mahd";    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mahd', $mahd, PDO::PARAM_INT);    
        $stmt->bindParam(':thanhtien', $thanhtien, PDO::PARAM_INT);    
        if ($stmt->execute()) 
        {
           return true;
        }  else{
            return false;
        }

    }

}
?>