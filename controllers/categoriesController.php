<?php

class categoriesController extends Controller {

    public function index() {
        $this->isLogged();
        $data = array();
        $user = new Users();
        $categories = new Categories();

        if(!empty($_POST['acao_category']) && isset($_POST['acao_category'])){
            if($_POST['acao_category'] == 'addNewCategory'){
                $name = addslashes($_POST['name']);
                echo $categories->addNewCategory($name);
                exit;
            }
            if($_POST['acao_category'] == 'editCategory'){
                $id = addslashes($_POST['id']);
                echo $categories->editCategory($id);
                exit;
            }
            if($_POST['acao_category'] == 'updCategory'){
                $id = addslashes($_POST['id']);
                $name = addslashes($_POST['name']);
                echo $categories->updCategory($id, $name);
                exit;
            }
            if($_POST['acao_category'] == 'deleteCategory'){
                $id = addslashes($_POST['id']);
                echo $categories->deleteCategory($id);
                exit;
            }
        }


        $data['categories'] = $categories->fetchAllCategories();
        $data['userInfo'] = $user->getUser();
        $this->loadTemplate('categories', $data);
    }
}