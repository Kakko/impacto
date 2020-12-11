<?php
class Products extends Model {
    
    public function getProducts() {
        $sql = $this->db->prepare("SELECT * FROM products ORDER BY id");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $data;
    }
}