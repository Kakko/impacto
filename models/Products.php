<?php
class Products extends Model {

    public function addProduct($name, $category, $author, $price, $type, $amazonLink, $googleLink, $edition_number, $edition_year, $language, $width, $height, $weight, $hasDiscount, $discount, $amount, $number_pages, $desc, $url){
        $array = array();

        $sql = $this->db->prepare("INSERT INTO products SET name = :name, price = :price, has_discount = :has_discount, discount = :discount, author = :author, category = :category, amount = :amount, type = :type, data_cadastro = now()");
        $sql->bindValue(":name", $name);
        $sql->bindValue(":price", $price);
        $sql->bindValue(":has_discount", $hasDiscount);
        $sql->bindValue(":discount", $discount);
        $sql->bindValue(":author", $author);
        $sql->bindValue(":category", $category);
        $sql->bindValue(":amount", $amount);
        $sql->bindValue(":type", $type);
        if($sql->execute()){
            $product_id = $this->db->lastInsertID();

            $sql = $this->db->prepare("INSERT INTO product_details SET product_id = :product_id, edition_number = :edition_number, edition_year = :edition_year, language = :language, width = :width, height = :height, weight = :weight, number_pages = :number_pages, description = :description, amazon_link = :amazon_link, google_link = :google_link");
            $sql->bindValue(":product_id", $product_id);
            $sql->bindValue(":edition_number", $edition_number);
            $sql->bindValue(":edition_year", $edition_year);
            $sql->bindValue(":language", $language);
            $sql->bindValue(":width", $width);
            $sql->bindValue(":height", $height);
            $sql->bindValue(":weight", $weight);
            $sql->bindValue(":number_pages", $number_pages);
            $sql->bindValue(":description", $desc);
            $sql->bindValue(":amazon_link", $amazonLink);
            $sql->bindValue(":google_link", $googleLink);
            $sql->execute();

            $tipo = $url['type'];

            if(in_array($tipo, array('image/jpeg', 'image/png'))) {

                $tmpname = md5(time(). rand(0,999)).'.jpg';
                move_uploaded_file($url['tmp_name'], './assets/images/products/'.$tmpname);

                $sql = $this->db->prepare("INSERT INTO product_images SET product_id = :product_id, url = :url, capa = :capa, data_cadastro = now()");
                $sql->bindValue(":product_id", $product_id);
                $sql->bindValue(":url", $tmpname);
                $sql->bindValue(":capa", '1');
                $sql->execute();
            }     
        };   
    }

    public function fetchProduct($id) {
        $dados = '';
        
        $sql = $this->db->prepare("SELECT * FROM products
                                    LEFT JOIN product_details ON (products.id = product_details.product_id)
                                    LEFT JOIN product_images ON (products.id = product_images.product_id)
                                    LEFT JOIN product_categories ON (products.category = product_categories.id)
                                    WHERE products.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
        }

        $data ='
            <div class="seeProductImage">
                <img src="./assets/images/products/'.$dados['url'].'">
            </div>
            <div class="seeProductInfo container-fluid">
                <div class="row">
                    <div class="col-sm">
                        <label>Título:</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="'.$dados['name'].'" readonly>
                    </div>
                    <div class="col-sm">
                        <label>Categoria:</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="'.$dados['category_name'].'" readonly>
                    </div>
                    <div class="col-sm">
                        <label>Autor(a):</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="'.$dados['author'].'" readonly>
                    </div>
                    <div class="col-sm">
                        <label>Quantidade:</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="'.$dados['amount'].'" readonly>
                    </div>
                    <div class="col-sm">
                        <label>Tipo do Produto:</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="'.$dados['type'].'" readonly>
                    </div>
                </div>
                <br/>
                <hr/>
                <br/>
                <div class="row">
                    <div class="col-sm">
                        <label>Número de Páginas:</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="'.$dados['number_pages'].'" readonly>
                    </div>
                    <div class="col-sm">
                        <label>Número da Edição:</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="'.$dados['edition_number'].'" readonly>
                    </div>
                    <div class="col-sm">
                        <label>Ano da Edição:</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="'.$dados['edition_year'].'" readonly>
                    </div>
                    <div class="col-sm">
                        <label>Idioma:</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="'.$dados['language'].'" readonly>
                    </div>
                    <div class="col-sm-2">
                    <label>Largura (Em CM):</label>
                    <input type="number" step=".01" class="form-control form-control-sm showProduct" name="width" value="'.$dados['width'].'">
                    </div>
                    <div class="col-sm-2">
                        <label>Altura (Em CM):</label>
                        <input type="number" step=".01" class="form-control form-control-sm showProduct" name="height" value="'.$dados['height'].'">
                    </div>
                    <div class="col-sm-2">
                        <label>Peso (Em KG):</label>
                        <input type="number" class="form-control form-control-sm showProduct" name="weight" value="'.$dados['weight'].'">
                    </div>
                </div>
                <br/>
                <hr/>
                <br/>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Descrição:</label>
                        <textarea class="form-control form-control-sm showProduct" style="resize: none; height: 200px" readonly>'.$dados['description'].'</textarea>
                    </div>
                    <div class="col-sm">
                        <label>Link da Amazon:</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="'.$dados['amazon_link'].'" readonly><br/>
                        <label>Link da Google Livros:</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="'.$dados['google_link'].'" readonly>
                    </div>
                    <div class="col-sm">
                        <label>Valor Original:</label>
                        <input type="text" class="form-control form-control-sm showProduct" value="R$ '.str_replace('.',',', $dados['price']).'" readonly><br/>';
                        if($dados['has_discount'] !== 'Não'){
                            $data .='
                            <label>Valor com desconto:</label>
                            <input type="text" class="form-control form-control-sm showProduct" value="R$ '.str_replace('.',',', $dados['price'] - ($dados['price'] / 100 * $dados['discount'])).'" readonly>';
                        }
                        $data .='
                    </div>
                </div>
            </div>
        ';

        return $data;
    }

    public function editProduct($id) {
        $data = '';
        
        $sql = $this->db->prepare("SELECT products.id AS prodID, product_categories.id AS catID, products.*, product_details.*, product_images.*, product_categories.* FROM products
                                    LEFT JOIN product_details ON (products.id = product_details.product_id)
                                    LEFT JOIN product_images ON (products.id = product_images.product_id)
                                    LEFT JOIN product_categories ON (products.category = product_categories.id)
                                    WHERE products.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $info = $sql->fetch(PDO::FETCH_ASSOC);
        }

        $sql = $this->db->prepare("SELECT * FROM product_categories ORDER BY category_name ASC");
        $sql->execute();

        if($sql->rowCount() > 0){
            $category = $sql->fetchAll(PDO::FETCH_ASSOC);
        }


        $sql = $this->db->prepare("SELECT * FROM product_images WHERE product_id = :id");
        $sql->bindValue(":id", $info['prodID']);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $images = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        $data ='
            <form method="POST" enctype="multipart/form-data" id="formProduct">
                <div class="row">
                    <div class="col-sm-6">
                        <label>Nome:</label>
                        <input type="text" name="acao_produtos" value="updProduct" hidden>
                        <input type="text" name="id" value="'.$info['prodID'].'" hidden>
                        <input type="text" class="form-control form-control-sm" name="name" value="'.$info['name'].'">
                    </div>
                    <div class="col-sm-3">
                        <label>Categoria:</label>
                        <div class="input-group">
                            <select class="custom-select custom-select-sm" name="category" id="newCat">
                                <option value="'.$info['catID'].'" readonly>'.$info['category_name'].'</option>
                                <option value="" disabled></option>';
                                    foreach($category as $cat){
                                        $data .='
                                            <option value="'.$cat['id'].'">'.$cat['category_name'].'</option>   
                                        ';
                                    }
                                $data .='
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-success btn-sm" type="button" onclick="addCategory()"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label>Autor:</label>
                        <input type="text" class="form-control form-control-sm" name="author" value="'.$info['author'].'">
                    </div>
                    <div class="col-sm-1">
                        <label>Preço:</label>
                        <input type="text" class="form-control form-control-sm" name="price" placeholder="R$" value="'.$info['price'].'">
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm-2">
                        <label>Tipo:</label>
                        <select class="form-control form-control-sm" name="type">
                            <option>'.$info['type'].'</option>
                            <option value="" disabled></option>
                            <option>Livro</option>
                            <option>Audiobook</option>
                            <option>E-Book</option>
                        </select>
                    </div>
                    <div class="col-sm" id="linkGoogle">
                        <label>Link Google Livros</label>
                        <input type="text" class="form-control form-control-sm" name="googleLink" value="'.$info['google_link'].'">
                    </div>

                    <div class="col-sm" id="linkAmazon">
                        <label>Link Amazon</label>
                        <input type="text" class="form-control form-control-sm" name="amazonLink" value="'.$info['amazon_link'].'">
                    </div>
                    <div class="col-sm">
                        <label>Edição:</label>
                        <input type="text" class="form-control form-control-sm" name="edition_number" value="'.$info['edition_number'].'">
                    </div>
                    <div class="col-sm">
                        <label>Ano da Edição:</label>
                        <input type="text" class="form-control form-control-sm" name="edition_year" value="'.$info['edition_year'].'">
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm-2">
                        <label>Idioma:</label>
                        <select class="form-control form-control-sm" name="language">
                            <option>'.$info['language'].'</option>
                            <option value="" disabled></option>
                            <option>Português</option>
                            <option>Inglês</option>
                            <option>Espanhol</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label>Largura (Em CM):</label>
                        <input type="number" step=".01" class="form-control form-control-sm" name="width" value="'.$info['width'].'">
                    </div>
                    <div class="col-sm-2">
                        <label>Altura (Em CM):</label>
                        <input type="number" step=".01" class="form-control form-control-sm" name="height" value="'.$info['height'].'">
                    </div>
                    <div class="col-sm-2">
                        <label>Peso (Em KG):</label>
                        <input type="number" class="form-control form-control-sm" name="weight" value="'.$info['weight'].'">
                    </div>
                    <div class="col-sm-2">
                        <label>Tem Desconto:</label>
                        <select class="form-control form-control-sm" name="hasDiscount" id="hasDiscount" onchange="showDiscount()">
                            <option>'.$info['has_discount'].'</option>
                            <option disabled></option>
                            <option value="Não">Não</option>
                            <option value="Sim">Sim</option>
                        </select>
                    </div>
                    <div class="col-sm-1" id="discountField">
                        <label>Porcentagem:</label>
                        <input type="number" step="0.1" class="form-control form-control-sm" name="discount" value="'.$info['discount'].'">
                    </div>
                    <div class="col-sm">
                        <label>Quantidade:</label>
                        <input type="number" class="form-control form-control-sm" name="amount" value="'.$info['amount'].'">
                    </div>
                    <div class="col-sm">
                        <label>Número de Páginas</label>
                        <input type="number" class="form-control form-control-sm" name="number_pages" value="'.$info['number_pages'].'">
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm-5">
                        <label>Descrição: (Máx 500 caractéres)</label>
                        <textarea class="form-control form-control-sm" style="resize: none; height: 200px" name="desc">'.$info['description'].'</textarea>
                    </div>
                    <div class="col-sm-3">
                        <label>Imagem do produto</label>
                        <div class="showCoverImage" id="showImages">';
                            foreach($images as $img) {
                                $data .='
                                    <div class="coverImage">
                                        <img src="./assets/images/products/'.$img['url'].'">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteImg('.$img['id'].')">Excluir</button>
                                    </div>
                                ';
                            }
                            $data .='
                        </div>
                    </div>
                    <div class="col-sm-4" style="border: 1px solid #4C7993; border-radius: 5px" id="updArea">';
                        if(count($images) < 2){
                            $data .='
                                <label>Selecione outra imagem: </label><br/>
                                <input type="file" name="upload_arquivos" id="updFile"><br/><br/>
                                <input class="btn btn-warning btn-sm" onclick="insertImg('.$info['prodID'].')" value="Enviar">
                                ';
                                
                        };
                        if(count($images) >= 2){
                            $data .='
                                <label>Limite Máximo de imagens atingido </label><br/>
                                ';
                        }
                            $data .='
                    </div>
                </div>
            </form>
        ';
        
        return $data;
    }

    public function updProduct($id, $name, $category, $author, $price, $type, $amazonLink, $googleLink, $edition_number, $edition_year, $language, $width, $height, $weight, $hasDiscount, $discount, $amount, $number_pages, $desc){
        $sql = $this->db->prepare("UPDATE products SET name = :name, price = :price, has_discount = :has_discount, discount = :discount, author = :author, category = :category, amount = :amount, type = :type, data_cadastro = now() WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":price", $price);
        $sql->bindValue(":has_discount", $hasDiscount);
        $sql->bindValue(":discount", $discount);
        $sql->bindValue(":author", $author);
        $sql->bindValue(":category", $category);
        $sql->bindValue(":amount", $amount);
        $sql->bindValue(":type", $type);
        if($sql->execute()){
            $sql = $this->db->prepare("UPDATE product_details SET product_id = :product_id, edition_number = :edition_number, edition_year = :edition_year, language = :language, width = :width, height = :height, weight = :weight, number_pages = :number_pages, description = :description, amazon_link = :amazon_link, google_link = :google_link WHERE product_id = :product_id");
            $sql->bindValue(":product_id", $id);
            $sql->bindValue(":edition_number", $edition_number);
            $sql->bindValue(":edition_year", $edition_year);
            $sql->bindValue(":language", $language);
            $sql->bindValue(":width", $width);
            $sql->bindValue(":height", $height);
            $sql->bindValue(":weight", $weight);
            $sql->bindValue(":number_pages", $number_pages);
            $sql->bindValue(":description", $desc);
            $sql->bindValue(":amazon_link", $amazonLink);
            $sql->bindValue(":google_link", $googleLink);
            $sql->execute();
        };

        
    }

    public function updImage($product_id, $img){
        $data1 = '';
        $tipo = $img['type'];

        if(in_array($tipo, array('image/jpeg', 'image/png'))) {

            $tmpname = md5(time(). rand(0,999)).'.jpg';
            move_uploaded_file($img['tmp_name'], './assets/images/products/'.$tmpname);

            $sql = $this->db->prepare("INSERT INTO product_images SET product_id = :product_id, url = :url, capa = :capa, data_cadastro = now()");
            $sql->bindValue(":product_id", $product_id);
            $sql->bindValue(":url", $tmpname);
            $sql->bindValue(":capa", '0');
            $sql->execute();

            $sql = $this->db->prepare("SELECT * FROM product_images WHERE product_id = :id");
            $sql->bindValue(":id", $product_id);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $images = $sql->fetchAll(PDO::FETCH_ASSOC);
            }

            foreach($images as $img){
                $data1 .='
                <div class="coverImage">
                    <img src="./assets/images/products/'.$img['url'].'">
                    <button class="btn btn-danger btn-sm" onclick="deleteImg('.$img['id'].')">Excluir</button>
                </div>
                ';
            }
            $data1 .='';
            
            return $data1;
        }

    }

    public function deleteImage($id){
        $data = '';

        $sql = $this->db->prepare("SELECT * FROM product_images WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $images = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        $sql = $this->db->prepare("DELETE FROM product_images WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        foreach($images as $img){
            $data .='
            <div class="coverImage">
                <img src="./assets/images/products/'.$img['url'].'">
                <button class="btn btn-danger btn-sm" onclick="deleteImg('.$img['id'].')">Excluir</button>
            </div>
            ';
        }
        $data .='';
        
        return $data;
    }

    public function deleteProduct($id){
        $sql = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $sql->bindValue(":id", $id);

        if($sql->execute()){
            $sql = $this->db->prepare("DELETE FROM product_details WHERE product_id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            $sql = $this->db->prepare("DELETE FROM product_images WHERE product_id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            return('Produto Excluído com Sucesso!');
        } else {
            return('Falha ao excluir Produto');
        }
        
    }
    
    public function getProducts() {
        $data = '';
        $sql = $this->db->prepare("SELECT products.id AS prodID, products.*, product_details.*,product_images.url, product_author.name AS author_name FROM products
                                    LEFT JOIN product_details ON (products.id = product_details.product_id)
                                    LEFT JOIN product_images ON (products.id = product_images.product_id)
                                    LEFT JOIN product_author ON (products.author = product_author.id)
                                    WHERE product_images.capa = 1 ORDER BY products.id DESC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $data;
    }

    public function getCategories() {
        $data = '';

        $sql = $this->db->prepare("SELECT * FROM product_categories ORDER BY category_name ASC");
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function addNewCategory($name) {
        $array = array();
        //Verify if don't already exists a category with the same name
        $sql = $this->db->prepare("SELECT * FROM product_categories WHERE category_name = :name");
        $sql->bindValue(":name", $name);
        $sql->execute();

        if($sql->rowCount() == 0){
            //If not, insert a new category name
            $sql = $this->db->prepare("INSERT INTO product_categories SET category_name = :name, data_cadastro = now()");
            $sql->bindValue(":name", $name);
            $sql->execute();

            //Fetch all categories to return data
            $sql = $this->db->prepare("SELECT * FROM product_categories ORDER BY category_name ASC");
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);
                
                $result ='
                <option value="" readonly>Selecione...</option>';
                    foreach($array as $cat){
                        $result .='
                        <option value="'.$cat['id'].'">'.$cat['category_name'].'</option>';
                    };
                $result .='';
            return $result;
            }        
        } else {
            //Fetch all categories to return data
            $sql = $this->db->prepare("SELECT * FROM product_categories ORDER BY category_name ASC");
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);
                
                $result ='
                <option value="" readonly>Selecione...</option>';
                    foreach($array as $cat){
                        $result .='
                        <option value="'.$cat['id'].'">'.$cat['category_name'].'</option>';
                    };
                $result .='';
            return $result;
            }
        }
    }

    public function addNewAuthor($name) {
        $array = array();
        //Verify if don't already exists an author with the same name
        $sql = $this->db->prepare("SELECT * FROM product_author WHERE name = :name");
        $sql->bindValue(":name", $name);
        $sql->execute();

        if($sql->rowCount() == 0){
            //If not, insert a new author name
            $sql = $this->db->prepare("INSERT INTO product_author SET name = :name, data_cadastro = now()");
            $sql->bindValue(":name", $name);
            $sql->execute();

            //Fetch all authors to return data
            $sql = $this->db->prepare("SELECT * FROM product_author ORDER BY name ASC");
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);
                
                $result ='
                <option value="" readonly>Selecione...</option>';
                    foreach($array as $aut){
                        $result .='
                        <option value="'.$aut['id'].'">'.$aut['name'].'</option>';
                    };
                $result .='';
            return $result;
            }        
        } else {
            //Fetch all authors to return data
            $sql = $this->db->prepare("SELECT * FROM product_author ORDER BY name ASC");
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);
                
                $result ='
                <option value="" readonly>Selecione...</option>';
                    foreach($array as $aut){
                        $result .='
                        <option value="'.$aut['id'].'">'.$aut['name'].'</option>';
                    };
                $result .='';
            return $result;
            }
        }
    }

    public function sendToCartGU($guest_user_id, $productID){
        $sql = $this->db->prepare("SELECT * FROM guest_user WHERE guest_user_id = :guest_user_id");
        $sql->bindValue(":guest_user_id", $guest_user_id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $updatedProductID = $data['itens_on_cart'].','.$productID;

            $sql2 = $this->db->prepare("UPDATE guest_user SET itens_on_cart = :itens_on_cart WHERE guest_user_id = :guest_user_id");
            $sql2->bindValue(":itens_on_cart", $updatedProductID);
            $sql2->bindValue(":guest_user_id", $guest_user_id);
            $sql2->execute();

            
        } else {
            $sql = $this->db->prepare("INSERT INTO guest_user SET guest_user_id = :guest_user_id, itens_on_cart = :itens_on_cart, data_cadastro = now()");
            $sql->bindValue(":guest_user_id", $guest_user_id);
            $sql->bindValue(":itens_on_cart", $productID);
            $sql->execute();
        }

        $sql = $this->db->prepare("SELECT itens_on_cart FROM guest_user WHERE guest_user_id = :guest_user_id");
        $sql->bindValue(":guest_user_id", $guest_user_id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            
            $data = explode(',', $data['itens_on_cart']);
            $count = count($data);
        }

        return $count;
    }

    public function getCartNumber($guest_id){
        $sql = $this->db->prepare("SELECT itens_on_cart FROM guest_user WHERE guest_user_id = :guest_user_id");
        $sql->bindValue(":guest_user_id", $guest_id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            
            $data = explode(',', $data['itens_on_cart']);
            $count = count($data);
        }

        return $count;
    }

    public function fetchGuestCart($id){
        $result = '';
        $sql = $this->db->prepare("SELECT * FROM guest_user WHERE guest_user_id = :guest_user_id");
        $sql->bindValue(":guest_user_id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            
            $data = explode(',', $data['itens_on_cart']);
            $result .='
                <div class="productsArea" id="guestCart">
                    <div class="cartTitle">Itens na sacola</div>
            ';

            
            foreach($data as $d){
                $sql = $this->db->prepare("SELECT products.*, product_author.name AS author_name, product_images.url AS url FROM products 
                                            LEFT JOIN product_author ON (product_author.id = products.author)
                                            LEFT JOIN product_images ON (products.id = product_images.product_id)
                                            WHERE products.id = :id");
                $sql->bindValue(":id", $d);
                $sql->execute();

                if($sql->rowCount() > 0){
                    $info = $sql->fetch(PDO::FETCH_ASSOC);
                }
                $result .='
                    <div class="cartProducts">
                        <div class="frontImage"><img src="./assets/images/products/'.$info['url'].'"></div>
                        <div class="cartInfoProduct">
                            <div class="cartTitleProduct">'.$info['name'].'</div>
                            <div class="cartAuthorProduct">'.$info['author_name'].'</div>
                            <div class="amount">Quantidade</div>
                            <div class="changeAmount">
                                <div class="lowerAmount" onclick="lowerProductAmount('.$info['id'].')"><img src="./assets/icons/less-icon1.svg"></div>
                                <input type="number" class="actualAmount" id="actualAmount'.$info['id'].'" value="1">
                                <div class="raiseAmount" onclick="raiseProductAmount('.$info['id'].')"><img src="./assets/icons/plus-icon1.svg"></div>
                            </div>
                        </div>
                        <div class="cartAction" onclick="removeProductCart('.$info['id'].')"><img src="./assets/icons/trash-bag-item.svg"></div>
                    </div>
                ';                
            }
            $result .='
            </div>
            <div class="subTotal">SubTotal:R$2000,00</div>';
            if(!isset($_SESSION['cUser'])){
                $result .='
                    <button class="closeCart" onclick="proceedToLog()">Finalizar Compra</button>';
            } else {
                $result .='
                    <button class="closeCart" onclick="proceedToFinish('.$_SESSION['cUser'].')">Finalizar Compra</button>
                ';
            }
            $result .='
            <button class="continueShopping" onclick="closeCartModal()">Continuar Comprando</button>
            ';
        }

        return $result;
    }

    public function removeProductCart($id, $userID) {

        $array = array();

        $sql = $this->db->prepare("SELECT itens_on_cart FROM guest_user WHERE itens_on_cart LIKE :id AND guest_user_id = :guest_user_id");
        $sql->bindValue(":id", "%".$id."%");
        $sql->bindValue(":guest_user_id", $userID);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }

        $array = explode(',', $array['itens_on_cart']);
        $key = array_search($id, $array);
        unset($array[$key]);
        
        $dados = implode(',', $array);

        $sql = $this->db->prepare("UPDATE guest_user SET itens_on_cart = :dados WHERE guest_user_id = :guest_user_id");
        $sql->bindValue(":dados", $dados);
        $sql->bindValue(":guest_user_id", $userID);
        $sql->execute();

        $result = '';
        $sql = $this->db->prepare("SELECT * FROM guest_user WHERE guest_user_id = :guest_user_id");
        $sql->bindValue(":guest_user_id", $userID);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            
            $data = explode(',', $data['itens_on_cart']);
            $result .='
                <div class="productsArea" id="guestCart">
                    <div class="cartTitle">Itens na sacola</div>
            ';

            
            foreach($data as $d){
                $sql = $this->db->prepare("SELECT products.*, product_author.name AS author_name, product_images.url AS url FROM products 
                                            LEFT JOIN product_author ON (product_author.id = products.author)
                                            LEFT JOIN product_images ON (products.id = product_images.product_id)
                                            WHERE products.id = :id");
                $sql->bindValue(":id", $d);
                $sql->execute();

                if($sql->rowCount() > 0){
                    $info = $sql->fetch(PDO::FETCH_ASSOC);
                }
                $result .='
                    <div class="cartProducts">
                        <div class="frontImage"><img src="./assets/images/products/'.$info['url'].'"></div>
                        <div class="cartInfoProduct">
                            <div class="cartTitleProduct">'.$info['name'].'</div>
                            <div class="cartAuthorProduct">'.$info['author_name'].'</div>
                            <div class="amount">Quantidade</div>
                            <div class="changeAmount">
                                <div class="lowerAmount" onclick="lowerProductAmount('.$info['id'].')"><img src="./assets/icons/less-icon1.svg"></div>
                                <input type="number" class="actualAmount" id="actualAmount'.$info['id'].'" value="1">
                                <div class="raiseAmount" onclick="raiseProductAmount('.$info['id'].')"><img src="./assets/icons/plus-icon1.svg"></div>
                            </div>
                        </div>
                        <div class="cartAction" onclick="removeProductCart('.$info['id'].')"><img src="./assets/icons/trash-bag-item.svg"></div>
                    </div>
                ';                
            }
            $result .='
            </div>
            <div class="subTotal">SubTotal:R$2000,00</div>';
            if(!isset($_SESSION['cUser'])){
                $result .='
                    <button class="closeCart" onclick="proceedToLog()">Finalizar Compra</button>';
            } else {
                $result .='
                    <button class="closeCart" onclick="proceedToFinish('.$_SESSION['cUser'].')">Finalizar Compra</button>
                ';
            }
            $result .='
            <button class="continueShopping" onclick="closeCartModal()">Continuar Comprando</button>
            ';
        }

        return $result;
    }

    public function updGuestToRegisteredCart($id){
        $sql = $this->db->prepare("SELECT * FROM guest_user WHERE registered_user_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            
            $products = explode(',', $data['itens_on_cart']);
            
            foreach($products as $prod){
                $sql = $this->db->prepare("INSERT INTO user_cart SET user_id = :id, product_id = :product_id, qtd = :qtd, data_cadastro = now()");
                $sql->bindValue(":id", $id);
                $sql->bindValue(":product_id", $prod);
                $sql->bindValue(":qtd", 1);
                $sql->execute();
            }

            $sql = $this->db->prepare("DELETE FROM guest_user WHERE registered_user_id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
        }
    }
    public function showRegisteredCartProducts($id) {
        $sql = $this->db->prepare("SELECT user_cart.*, product_images.url, products.*, product_author.name AS author_name FROM user_cart 
                                    LEFT JOIN product_images ON (user_cart.product_id = product_images.product_id)
                                    LEFT JOIN products ON (user_cart.product_id = products.id)
                                    LEFT JOIN product_author ON (products.author = product_author.id)
                                    WHERE user_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $products = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $products;
    }

    public function lowerProductAmount($id, $qtd){
       
        $sql = $this->db->prepare("UPDATE user_cart SET qtd = :qtd WHERE product_id = :id");
        $sql->bindValue(":qtd", $qtd);
        $sql->bindValue(":id", $id);
        $sql->execute();

    }
    public function raiseProductAmount($id, $qtd){

        $sql = $this->db->prepare("UPDATE user_cart SET qtd = :qtd WHERE product_id = :id");
        $sql->bindValue(":qtd", $qtd);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function chosenCEP($id, $cep_destino){
        $sql = $this->db->prepare("UPDATE clients SET chosen_cep = :cep WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":cep", $cep_destino);
        $sql->execute();
    }

    public function updateFinalPrice($id){
        $data = '';
        $finalPrice = 0;
        $sql = $this->db->prepare("SELECT user_cart.*, products.id AS prod_id, products.* FROM user_cart 
                                    LEFT JOIN products ON (user_cart.product_id = products.id)
                                    WHERE user_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($info as $i){
                if($i['has_discount'] == 'Sim'){
                    $finalPrice += ($i['price'] - ($i['price'] / 100 * $i['discount'])) * $i['qtd'];
                } else {
                    $finalPrice += $i['price'] * $i['qtd'];
                }
            }
            
            $data .='
                <label>Total a pagar</label><br/>
                <input type="text" value="'.$finalPrice.'" id="totalProductsPrice" hidden>
                <div class="finalPrice">R$ '.number_format($finalPrice, 2, '.', '.').'</div>
                <button class="buyout" onclick="proceedToIdentify()" disabled>Continuar</button>
            ';
        }

        return $data;
    }
}