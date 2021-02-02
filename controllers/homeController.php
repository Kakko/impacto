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
            if($_POST['user_action'] == 'loginAction'){ // Efetua o Login
                $email = addslashes($_POST['loginEmail']);
                $password = addslashes($_POST['loginPassword']);
                $userSessionId = addslashes($_POST['userSessionID']);

                $client->loginClient($email, $password, $userSessionId);

            }
            if($_POST['user_action'] == 'getCartNumber'){ //Exibe a quantidade de produtos no carrinho
                $guest_id = addslashes($_POST['guest_id']);

                echo $products->getCartNumber($guest_id);
                exit;
            }
            if($_POST['user_action'] == 'sendToCartGU'){ // Envia o item para o carrinho do usuário
                if(!empty($_SESSION['cUser']) && isset($_SESSION['cUser'])){
                    $registeredUser = $_SESSION['cUser'];
                    $guest_user_id = session_id();
                    $productID = addslashes($_POST['id']);

                    echo $products->sendToCartGU($registeredUser, $guest_user_id, $productID);
                    exit;
                } else {
                    $registeredUser = null;
                    $guest_user_id = session_id();
                    $productID = addslashes($_POST['id']);
    
                    echo $products->sendToCartGU($registeredUser, $guest_user_id, $productID);
                    exit;
                }
            }  
            if($_POST['user_action'] == 'fetchGuestCart'){ // Exibe os dados do carrinho do usuário
                $id = addslashes($_POST['guest_id']);

                echo $products->fetchGuestCart($id);
                exit;
            }
            if($_POST['user_action'] == 'removeProductCart'){ // Remove um produto do carrinho
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
        $this->isClientLogged();

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
            if($_POST['cart_action'] == 'proceedToIdentify'){
                $id = $_SESSION['cUser'];
                $finalPrice = addslashes($_POST['finalPrice']);

                echo $products->proceedToIdentify($id, $finalPrice);
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
        $frete = new CalcularFrete();
        $this->isClientLogged();

        if(!empty($_POST['cart_action']) && isset($_POST['cart_action'])){
            if($_POST['cart_action'] == 'updatePurchase'){

                $cep_destino = addslashes($_POST['cep']);
                $price = addslashes($_POST['finalPrice']);
                $cod_servico = addslashes($_POST['postService']);
                $id = $_SESSION['cUser'];
                echo $frete->calculaFrete($id, $cep_destino, $cod_servico, $price);
                exit;
            }
            if($_POST['cart_action'] == 'proceedToPayment'){
                $receiverName = addslashes($_POST['receiverName']);
                $receiverDocs = addslashes($_POST['receiverDocs']);
                $receiverEmail = addslashes($_POST['receiverEmail']);
                $receiverPhone = addslashes($_POST['receiverPhone']);
                $finalPrice = addslashes($_POST['finalPrice']);
                $cep = addslashes($_POST['cep']);
                $client_id = $_SESSION['cUser'];

                echo $client->proceedToPayment($receiverName, $receiverDocs, $receiverEmail, $receiverPhone, $finalPrice, $cep, $client_id);
                exit;
            }
            if($_POST['cart_action'] == 'addCardDeets'){
                $cardNumber = addslashes($_POST['cardNumber']);
                $cardName = addslashes($_POST['cardName']);
                $expMonth = addslashes($_POST['expMonth']);
                $expYear = addslashes($_POST['expYear']);
                $cardCvv = addslashes($_POST['cardCvv']);
                $client_id = $_SESSION['cUser'];

                echo $client->addCard($cardNumber, $cardName, $expMonth, $expYear, $cardCvv, $client_id);
                exit;
            }
            if($_POST['cart_action'] == 'finishInsertData'){
                $cardId = addslashes($_POST['cardId']);
                $cep = addslashes($_POST['cep']);
                $id = $_SESSION['cUser'];

                $client->finishInsertData($cardId, $cep, $id);
                exit;
            }
        }

        $data['cards'] = $client->fetchSavedCards($_SESSION['cUser']);
        $data['purchaseDeets'] = $client->purchaseDeets($_SESSION['cUser']);
        $data['clientAddress'] = $client->fetchClientAddress($_SESSION['cUser']);
        $data['cartProducts'] = $products->showRegisteredCartProducts($_SESSION['cUser']);
        $this->loadView('identification', $data);
    }

    public function finishPurchaseCard(){
        $data = array();
        $products = new Products();
        $this->isClientLogged();
        
        $data['deliverDeets'] = $products->deliverInfo($_SESSION['cUser']);
        $data['purchaseInfo'] = $products->purchaseInfo($_SESSION['cUser']);
        $data['cartProducts'] = $products->showRegisteredCartProducts($_SESSION['cUser']);
        $this->loadView('cardFinished', $data);
    }

    public function logout() {
        $client = new Clients();

        $client->logoutClient();
        header("Location: ".BASE_URL);
        exit;
    }

}