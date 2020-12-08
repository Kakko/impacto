<?php
class homeController extends Controller {

    public function index() {
        $data = array();

        $this->loadView('home', $data);
    }

}