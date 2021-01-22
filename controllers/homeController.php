<?php
class homeController extends Controller {

    public function index() {
        $data = array();
        $products = new Products();
        $client = new Clients();
        
        if(!empty($_POST['user_action']) && isset($_POST['user_action'])) {
            if($_POST['user_action'] == 'register'){
                $name = addslashes($_POST['name']);
                $email = addslashes($_POST['email']);
                $password = addslashes(md5($_POST['password']));

                $client->registerClient($name, $email, $password);
            }
            if($_POST['user_action'] == 'loginAction'){
                $email = addslashes($_POST['loginEmail']);
                $password = addslashes($_POST['loginPassword']);
                $userSessionId = addslashes($_POST['userSessionID']);

                $client->loginClient($email, $password, $userSessionId);

            }
            if($_POST['user_action'] == 'getCartNumber'){
                $guest_id = addslashes($_POST['guest_id']);

                echo $products->getCartNumber($guest_id);
                exit;
            }
            if($_POST['user_action'] == 'sendToCartGU'){
                $guest_user_id = session_id();
                $productID = addslashes($_POST['id']);

                echo $products->sendToCartGU($guest_user_id, $productID);
                exit;
            }  
            if($_POST['user_action'] == 'fetchGuestCart'){
                $id = addslashes($_POST['guest_id']);

                echo $products->fetchGuestCart($id);
                exit;
            }
            if($_POST['user_action'] == 'removeProductCart'){
                $id = addslashes($_POST['id']);
                $userID = addslashes($_POST['userID']);
                
                echo $products->removeProductCart($id, $userID);
                exit;
            }
            if($_POST['user_action'] == 'proceedToCart'){
                header("Location: ".BASE_URL."home/cart");
                exit;
            }
        }
        $data['clients'] = $client->fetchClient();
        $data['products'] = $products->getProducts();
        $this->loadView('home', $data);
    }

    public function cart(){
        $data = array();
        $products = new Products();
        $client = new Clients();
        $frete = new CalcularFrete();
        $id = $_SESSION['cUser'];

        if(!empty($_POST['cart_action']) && isset($_POST['cart_action'])){
            if($_POST['cart_action'] == 'lowerProductAmount'){
                $id = addslashes($_POST['id']);
                $qtd = addslashes($_POST['qtd']);
                
                $products->lowerProductAmount($id, $qtd);
                exit;
            }
            if($_POST['cart_action'] == 'raiseProductAmount'){
                $id = addslashes($_POST['id']);
                $qtd = addslashes($_POST['qtd']);
                
                $products->raiseProductAmount($id, $qtd);
                exit;
            }
            if($_POST['cart_action'] == 'calcular_frete'){
                $id = addslashes($_POST['id']);
                $cep_destino = addslashes($_POST['cep']);
                $cod_servico = ($_POST['postService']);
                $price = addslashes($_POST['price']);

                echo $frete->calculaFrete($id, $cep_destino, $cod_servico, $price);
                $products->chosenCEP($id, $cep_destino);
                exit;
            }
            if($_POST['cart_action'] == 'updateFinalPrice'){
                $id = $_SESSION['cUser'];

                echo $products->updateFinalPrice($id);
                exit;
            }
            if($_POST['cart_action'] == 'updatePurchase'){
                $cep = addslashes($_POST['cep']);
                $finalPrice = addslashes($_POST['finalPrice']);
                $id = $_SESSION['cUser'];
                echo $client->updatePurchase($id, $cep, $finalPrice);
                exit;
            }
        }

        $data['cartProducts'] = $products->showRegisteredCartProducts($id);
        $products->updGuestToRegisteredCart($id);
        $data['clients'] = $client->fetchClient();
        $data['products'] = $products->getProducts();
        $this->loadView('cartUserArea', $data);
    }

    public function identification(){
        $data = array();
        $products = new Products();
        $client = new Clients();

        $data['purchaseDeets'] = $client->purchaseDeets($_SESSION['cUser']);
        $data['clientAddress'] = $client->fetchClientAddress($_SESSION['cUser']);
        $data['cartProducts'] = $products->showRegisteredCartProducts($_SESSION['cUser']);
        $this->loadView('identification', $data);
    }

    public function logout() {
        $client = new Clients();

        $client->logoutClient();
        header("Location: ".BASE_URL);
        exit;
    }

}