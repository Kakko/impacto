<?php
class Authors extends Model {

    public function fetchAllAuthors() {
        $data = array();
        $sql = $this->db->prepare("SELECT * FROM product_author ORDER BY name ASC");
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $data;
    }

    public function addNewAuthor($name){
        $sql = $this->db->prepare("INSERT INTO product_author SET name = :author_name, data_cadastro = now()");
        $sql->bindValue(":author_name", $name);
        $sql->execute();
    }

    public function editAuthor($id){
        $data = '';
        $sql = $this->db->prepare("SELECT * FROM product_author WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $info = $sql->fetch(PDO::FETCH_ASSOC);
        }

        $data .='
        <div class="row">
            <div class="col-sm">
                <label>Nome do Autor:</label>
                <input type="text" value="'.$info['id'].'" name="id" id="authorId" hidden>
                <input type="text" class="form-control form-control-sm" name="authorName" id="editAuthorName" value="'.$info['name'].'" required>
            </div>
        </div>
        ';

        return $data;
    }

    public function updAuthor($id, $name){
        $sql = $this->db->prepare("UPDATE product_author SET name = :name WHERE id = :id");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function deleteAuthor($id){
        $sql = $this->db->prepare("SELECT * FROM products WHERE author = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() == 0){
            $sql = $this->db->prepare("DELETE FROM product_author WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            return('Autor Excluido com Sucesso');
        } else {
            return('Erro - Existem produtos cadastrados com esse autor');
        }
    }
}