<?php
class productsController extends Controller {

    public function index() {
        $this->isLogged();
        $data = array();
        $user = new Users();
        $product = new Products();
        $author = new Authors();

        if(!empty($_POST['acao_produtos']) && isset($_POST['acao_produtos'])){
            if($_POST['acao_produtos'] == 'addNewCategory'){
                $name = addslashes($_POST['name']);
                echo $product->addNewCategory($name);
                exit;
            }

            if($_POST['acao_produtos'] == 'addNewAuthor'){
                $name = addslashes($_POST['name']);
                echo $product->addNewAuthor($name);
                exit;
            }

            if($_POST['acao_produtos'] == 'cadProduto') {
                $name = addslashes($_POST['name']);
                $category = addslashes($_POST['category']);
                $author = addslashes($_POST['author']);
                $price = addslashes(str_replace(',','.', $_POST['price']));
                $type = addslashes($_POST['type']);
                $amazonLink = addslashes($_POST['amazonLink']);
                $googleLink = addslashes($_POST['googleLink']);
                $edition_number = addslashes($_POST['edition_number']);
                $edition_year = addslashes($_POST['edition_year']);
                $language = addslashes($_POST['language']);
                $width = addslashes($_POST['width']);
                $height = addslashes($_POST['height']);
                $hasDiscount = addslashes($_POST['hasDiscount']);
                if($hasDiscount == 'Não'){
                    $discount = 0;
                } else {
                    $discount = addslashes($_POST['discount']);
                }
                $amount = addslashes($_POST['amount']);
                $desc = addslashes($_POST['desc']);
                $number_pages = addslashes($_POST['number_pages']);
                
                if(!empty($_FILES['upload_arquivos']['name'][0])){
                    $url = $_FILES['upload_arquivos'];
                }

                echo $product->addProduct($name, $category, $author, $price, $type, $amazonLink, $googleLink, $edition_number, $edition_year, $language, $width, $height, $hasDiscount, $discount, $amount, $number_pages, $desc, $url);
                header('Location: '.BASE_URL.'products');
                exit;
            }

            if($_POST['acao_produtos'] == 'see_produto') {
                $id = addslashes($_POST['id']);

                echo $product->fetchProduct($id);
                exit;
            }

            if($_POST['acao_produtos'] == 'edit_produto') {
                $id = addslashes($_POST['id']);

                echo $product->editProduct($id);
                exit;
            }

            if($_POST['acao_produtos'] == 'deleteImg'){
                $id = addslashes($_POST['id']);

                echo $product->deleteImage($id);
                exit;
            }

            if($_POST['acao_produtos'] == 'updProduct') {
                $id = addslashes($_POST['id']);
                $name = addslashes($_POST['name']);
                $category = addslashes($_POST['category']);
                $author = addslashes($_POST['author']);
                $price = addslashes(str_replace(',','.', $_POST['price']));
                $type = addslashes($_POST['type']);
                $amazonLink = addslashes($_POST['amazonLink']);
                $googleLink = addslashes($_POST['googleLink']);
                $edition_number = addslashes($_POST['edition_number']);
                $edition_year = addslashes($_POST['edition_year']);
                $language = addslashes($_POST['language']);
                $width = addslashes($_POST['width']);
                $height = addslashes($_POST['height']);
                $hasDiscount = addslashes($_POST['hasDiscount']);
                if($hasDiscount == 'Não'){
                    $discount = 0;
                } else {
                    $discount = addslashes($_POST['discount']);
                }
                $amount = addslashes($_POST['amount']);
                $desc = addslashes($_POST['desc']);
                $number_pages = addslashes($_POST['number_pages']);

                $product->updProduct($id, $name, $category, $author, $price, $type, $amazonLink, $googleLink, $edition_number, $edition_year, $language, $width, $height, $hasDiscount, $discount, $amount, $number_pages, $desc);
                // header("Location: ".BASE_URL."products");
                exit;
            }

            if($_POST['acao_produtos'] == 'updImage'){
                $product_id = addslashes($_POST['product_id']);
                $img = $_FILES['files'];
                echo $product->updImage($product_id, $img);
                exit;
            }

            if($_POST['acao_produtos'] == 'deleteProduct'){
                $id = addslashes($_POST['id']);
                echo $product->deleteProduct($id);
                exit;
            }
        }
        
        $data['authors'] = $author->fetchAllAuthors();
        $data['getProducts'] = $product->getProducts();
        $data['userInfo'] = $user->getUser();
        $data['categoryProduct'] = $product->getCategories();
        $this->loadTemplate('products', $data);
    }
}