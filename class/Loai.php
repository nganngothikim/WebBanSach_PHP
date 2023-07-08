<?php
class Loai
{

    public $maloai;
    public $tenloai;


    public static function getAll($pdo) {
        $sql = "SELECT * FROM loai";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Loai');
            return $stmt->fetchAll();
        }
    }

    // public function create($pdo) {
    //     $sql = "INSERT INTO product(promaloai, catmaloai) 
    //             VALUES (:promaloai, :catmaloai)";
    //     $stmt = $pdo->prepare($sql);
    //     $stmt->bindValue(':tenloai', $this->tenloai, PDO::PARAM_INT);
    //     $stmt->bindValue(':desc', $this->description, PDO::PARAM_INT);


    //     if ($stmt->execute()) {
    //         $this->maloai = $pdo->lastInsertmaloai();
    //         return true;
    //     }
    // }



}