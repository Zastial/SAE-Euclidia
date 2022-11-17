<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("UserModel");
        $this->load->model("ProductModel");
    }
    
    public function index(){
        $users = $this->UserModel->findAll();
        $products = $this->ProductModel->findAll();
        $this->load->view("admin", array('products'=>$products, 'users'=>$users));
    }

    
}
?>