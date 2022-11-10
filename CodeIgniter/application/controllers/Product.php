<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("ProductModel");
        $this->load->helper("url");
    }
    
    public function index(){
        $produits = $this->ProductModel->findAll();
        $this->load->view("products", array("produits"=>$produits));
    }

    public function show($id){
        
    }

    public function showall(){
        var_dump($this->ProductModel->findAll());
    }

}
