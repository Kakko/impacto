<?php
class clientsController extends Controller {

    public function index() {
        $this->isLogged(); // Verifica se o usuário está logado
        $data = array();
        $user = new Users();
        

        $data['userInfo'] = $user->getUser();
        $this->loadTemplate('clients', $data);
    }

    public function editar() {
        $data = array();
        $client = new Clients();
        $util = new Utils();
        $id = $_GET['id'];

        if(!empty($_POST['acao_clientes']) && isset($_POST['acao_clientes'])){
            if($_POST['acao_clientes'] == 'edit_myInfo'){
                $id = addslashes($_POST['id']);

                echo $client->editMyInfo($id);
                exit;
            }

            if($_POST['acao_clientes'] == 'updInfo') {
                $id = addslashes($_POST['id']);
                $name = addslashes($_POST['name']);
                $surname = addslashes($_POST['surname']);
                $cpf_cnpj = addslashes($_POST['cpf_cnpj']);
                $email = addslashes($_POST['email']);
                $phone = addslashes($_POST['phone']);

                echo $client->updMyInfo($id, $name, $surname, $cpf_cnpj, $email, $phone);
                exit;
            }

            if($_POST['acao_clientes'] == 'shipmentAddress') {
                $id = addslashes($_POST['id']);

                echo $client->shipmentAddress($id);
                exit;
            }
            if($_POST['acao_clientes'] == 'fetch_cities') {
                $state_id = addslashes($_POST['state']);

                echo $util->fetchCities($state_id);
                exit;
            }

            if($_POST['acao_clientes'] == 'addNewAddress') {
                $client_id = addslashes($_POST['id']);
                $cep = addslashes($_POST['cep']);
                $street = addslashes($_POST['street']);
                $number = addslashes($_POST['number']);
                $complement = addslashes($_POST['complement']);
                $neighborhood = addslashes($_POST['neighborhood']);
                $uf = addslashes($_POST['uf']);
                $city = addslashes($_POST['city']);

                echo $client->addNewAddress($client_id, $cep, $street, $number, $complement, $neighborhood, $uf, $city);
                exit;
            }

            if($_POST['acao_clientes'] == 'another_address'){
                $id = addslashes($_POST['id']);

                echo $client->newFormAddress($id);
                exit;
            }
        }

        $data['clients'] = $client->fetchClient();
        $this->loadView('editClient', $data);
    }
}