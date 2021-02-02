<?php
class Controller {

	protected $db;

	public function __construct() {
		global $config;
	}
	
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		include 'views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	// VERIFICA SE O USUÁRIO ADMINISTRATIVO ESTÁ LOGADO
	public function isLogged(){
		$user = new Users();
		if($user->isLogged() === false) {
            header("Location: ".BASE_URL."admLogin");
            exit;
        }
	}
	public function isClientLogged(){
		$client = new Clients();
		if($client->isLogged() === false) {
            header("Location: ".BASE_URL);
            exit;
        }
	}

}