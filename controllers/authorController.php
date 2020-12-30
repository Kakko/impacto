<?php
class authorController extends Controller {

    public function index(){
        $this->isLogged();
        $data = array();
        $user = new Users();

        $data['userInfo'] = $user->getUser();
        $this->loadTemplate('autores', $data);
    }
}