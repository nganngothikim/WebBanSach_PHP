<?php
class SanPham
{
    public $masp;
    public $tensp;
    public $mota;
    public $gia;
    public $hinhanh;
    public $maloai;

    public static function getAll($pdo) {
        $sql = "SELECT * FROM sanpham";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'SanPham');
            return $stmt->fetchAll();
        }
    }


    public static function getPage($pdo, $limit, $offset) {
        $sql = "SELECT * FROM sanpham ORDER BY masp LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'SanPham');
            return $stmt->fetchAll();
        }
    }



    public static function getOneBymasp($pdo, $masp) {
        $sql = "SELECT * FROM sanpham WHERE masp = :masp";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':masp', $masp, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'SanPham');
            return $stmt->fetch();
        }
    }

    public function create($pdo) {
        $sql = "INSERT INTO sanpham(tensp, hinhanh, gia, mota, maloai) 
                VALUES (:tensp, :hinhanh, :gia, :mota, :maloai)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':tensp', $this->tensp, PDO::PARAM_STR);
        $stmt->bindValue(':mota', $this->mota, PDO::PARAM_STR);
        $stmt->bindValue(':gia', $this->gia, PDO::PARAM_INT);
        $stmt->bindValue(':hinhanh', $this->hinhanh, PDO::PARAM_STR);
        $stmt->bindValue(':maloai', $this->maloai, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $this->masp = $pdo->lastInsertId();
            return true;
        }
    }

    public function removesanpham($pdo, $masp)
    {
        $sql = "DELETE FROM sanpham WHERE masp=:masp";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':masp', $masp, PDO::PARAM_INT);
        if ($stmt->execute()) 
        {
            return true;
        }
        else{
            return false;
        }

    }
    
    public function editsanpham($pdo, $tensp, $mota, $gia, $hinhanh, $masp, $maloai)
    {
        $sql = "UPDATE sanpham SET tensp=:tensp, hinhanh=:hinhanh, gia=:gia, mota=:mota, maloai=:maloai WHERE masp=:masp";    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':tensp', $tensp, PDO::PARAM_STR);    
        $stmt->bindParam(':mota', $mota, PDO::PARAM_STR);    
        $stmt->bindParam(':gia', $gia, PDO::PARAM_INT);    
        $stmt->bindParam(':masp', $masp, PDO::PARAM_INT);
        $stmt->bindParam(':hinhanh', $hinhanh, PDO::PARAM_STR); 
        $stmt->bindParam(':maloai', $maloai, PDO::PARAM_INT);
        if ($stmt->execute()) 
        {
           return true;
        }  else{
            return false;
        }

    }
    public static function truncate($chuoi, $do_dai) {
        if (strlen($chuoi) > $do_dai) {
            $chuoi = substr($chuoi, 0, $do_dai) . "...";
        }
        return $chuoi;
    }

    public static function getDSSanPhamByMaLoai($pdo, $maloai, $limit, $offset) {
        $sql = "SELECT * FROM sanpham where maloai=:maloai ORDER BY masp LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':maloai', $maloai, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'SanPham');
            return $stmt->fetchAll();
        }
    }
    public static function timKiemSanPham($pdo, $chuoitim, $limit, $offset) {
        $sql = "SELECT * FROM sanpham WHERE tensp LIKE :chuoitim ORDER BY masp LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':chuoitim', '%'.$chuoitim.'%', PDO::PARAM_STR);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'SanPham');
            return $stmt->fetchAll();
        }
    } 
    
}