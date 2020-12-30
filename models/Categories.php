<?php
class Categories extends Model {

    public function fetchAllCategories() {
        $data = array();
        $sql = $this->db->prepare("SELECT * FROM product_categories ORDER BY category_name ASC");
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function addNewCategory($name){
        $sql = $this->db->prepare("INSERT INTO product_categories SET category_name = :category_name, data_cadastro = now()");
        $sql->bindValue(":category_name", $name);
        $sql->execute();
    }

    public function editCategory($id){
        $data = '';
        $sql = $this->db->prepare("SELECT * FROM product_categories WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $info = $sql->fetch(PDO::FETCH_ASSOC);
        }

        $data .='
        <div class="row">
            <div class="col-sm">
                <label>Nome da Categoria:</label>
                <input type="text" value="'.$info['id'].'" name="id" id="categoryId" hidden>
                <input type="text" class="form-control form-control-sm" name="categoryName" id="editCategoryName" value="'.$info['category_name'].'" required>
            </div>
        </div>
        ';

        return $data;
    }

    public function updCategory($id, $name){
        $sql = $this->db->prepare("UPDATE product_categories SET category_name = :name WHERE id = :id");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function deleteCategory($id){
        $sql = $this->db->prepare("SELECT * FROM products WHERE category = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() == 0){
            $sql = $this->db->prepare("DELETE FROM product_categories WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            return('Categoria Excluida com Sucesso');
        } else {
            return('Erro - Existem produtos cadastrados com essa categoria');
        }
    }
}