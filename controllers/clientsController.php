<?php
class clientsController extends Controller {

    public function index() {
        $this->isLogged(); // Verifica se o usuário está logado
        $data = array();
        $user = new Users();
        

        $data['userInfo'] = $user->getUser();
        $this->loadTemplate('clients', $data);
    }
}