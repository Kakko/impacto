<?php
class homeController extends Controller {

    public function index() {
        $data = array();
        $products = new Products();

        $data['products'] = $products->getProducts();
        $this->loadView('home', $data);
    }

}