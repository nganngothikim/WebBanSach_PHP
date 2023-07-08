<?php
class ChiTietHoaDon
{

    public $mahd;
    public $masp;
    public $soluong;

    public static function getAll($pdo)
    {
        $sql = "SELECT * FROM chitiethoadon";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'ChiTietHoaDon');
            return $stmt->fetchAll();
        }
    }

    public static function getChiTietByMaHD($pdo, $mahd)
    {
        $sql = "SELECT * FROM chitiethoadon where mahd=:mahd";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mahd', $mahd, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'ChiTietHoaDon');
            return $stmt->fetchAll();
        }
    }


    public function create($pdo, $mahd, $masp, $soluong)
    {   

        $sql = "INSERT INTO chitiethoadon (mahd, masp, soluong) VALUES (:mahd, :masp, :soluong)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mahd', $mahd, PDO::PARAM_STR);
        $stmt->bindParam(':masp', $masp, PDO::PARAM_INT);
        $stmt->bindParam(':soluong', $soluong, PDO::PARAM_INT);
        return $stmt->execute();

    }

    public function removegiohang_All($pdo, $username)
    {
        $sql = "DELETE FROM giohang WHERE username=:username";    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }


    public function removegiohang($pdo, $proid, $username)
    {
        $sql = "DELETE FROM giohang WHERE proid=:proid and username=:username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':proid', $proid, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }


    public function updateQuantity($pdo, $proid, $username, $quantity)
    {
        $sql = "UPDATE giohang SET quantity=:quantity WHERE username=:username AND proid=:proid";    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);    
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);    
        $stmt->bindParam(':proid', $proid, PDO::PARAM_INT);    

        if ($stmt->execute()) 
        {
           return true;
        }  else{
            return false;
        }

    }
}
?>