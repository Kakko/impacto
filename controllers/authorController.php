<?php
class authorController extends Controller {

    public function index(){
        $this->isLogged();
        $data = array();
        $user = new Users();
        $author = new Authors();

        if(!empty($_POST['acao_author']) && isset($_POST['acao_author'])){
            if($_POST['acao_author'] == 'addNewAuthor'){
                $name = addslashes($_POST['name']);
                echo $author->addNewAuthor($name);
                exit;
            }
            if($_POST['acao_author'] == 'editAuthor'){
                $id = addslashes($_POST['id']);
                echo $author->editAuthor($id);
                exit;
            }
            if($_POST['acao_author'] == 'updAuthor'){
                $id = addslashes($_POST['id']);
                $name = addslashes($_POST['name']);
                echo $author->updAuthor($id, $name);
                exit;
            }
            if($_POST['acao_author'] == 'deleteAuthor'){
                $id = addslashes($_POST['id']);
                echo $author->deleteAuthor($id);
                exit;
            }
        }

        $data['authors'] = $author->fetchAllAuthors();
        $data['userInfo'] = $user->getUser();
        $this->loadTemplate('autores', $data);
    }
}