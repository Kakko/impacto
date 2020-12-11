<?php
class admLoginController extends Controller {

    public function index() {
        $data = array();
        $user = new Users();

        if(!empty($_POST['email']) && isset($_POST['password'])) {
            $email = addslashes($_POST['email']);
            $password = addslashes(md5($_POST['password']));

            if($user->doLogin($email, $password)) {
                header("Location: ".BASE_URL."admin");
                exit;
            } else {
                $data['error'] = 'Usuário e / ou senha inválidos';
                exit;
            }
        }
        $this->loadView('admLogin', $data);
    }

    public function logout() {
        $user = new Users();

        $user->logout();
        header("Location: ".BASE_URL."admLogin");
        exit;
    }
}