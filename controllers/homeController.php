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

                $client->loginClient($email, $password);
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

        $data['clients'] = $client->fetchClient();
        $data['products'] = $products->getProducts();
        $this->loadView('cartUserArea', $data);
    }

    public function logout() {
        $client = new Clients();

        $client->logoutClient();
        header("Location: ".BASE_URL);
        exit;
    }

}