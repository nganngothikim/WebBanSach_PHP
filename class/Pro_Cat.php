<?php
class Pro_Cat
{

    public $proid;
    public $catid;

    public function create($pdo) {
        $sql = "INSERT INTO pro_cat(proid, catid) 
                VALUES (:proid, :catid)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':proid', $this->proid, PDO::PARAM_INT);
        $stmt->bindValue(':catid', $this->catid, PDO::PARAM_INT);


        if ($stmt->execute()) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getCatIdByProID($pdo, $proid) {
        $sql = "SELECT * from pro_cat where proid = :proid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':proid', $proid, PDO::PARAM_INT);  
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pro_Cat');
            return $stmt->fetchAll();
        }
    }

    public function editPro_Cat($pdo, $proid, $catid)
    {
        $sql = "UPDATE pro_cat SET catid=:catid WHERE proid=:proid";    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':price', $proid, PDO::PARAM_INT);    
        $stmt->bindParam(':id', $catid, PDO::PARAM_INT);

        if ($stmt->execute()) 
        {
           return true;
        }  else{
            return false;
        }

    }

}