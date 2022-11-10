<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShoppingCart extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("ProductModel");
        $this->load->helper("url");
    }

    public function index(){
        $this->load->view("shoppingCart");
    }

}

   





?>