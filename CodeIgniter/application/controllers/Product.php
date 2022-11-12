<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("ProductModel");
        $this->load->model("CategorieModel");
        $this->load->helper("url");
    }
    
    public function find(){
        $produits = $this->ProductModel->findAll();
        $categories = $this->CategorieModel->findAll();
        $this->load->view("products", array("produits"=>$produits, "categories"=>$categories));
    }

    public function getFilteredProducts() {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
            show_404();
            die();
        }
        $categories = $this->input->post('categories');
        if (empty($categories)) {
            $produits = $this->ProductModel->findAll();
        } else {
            $produits = $this->ProductModel->findByCategories($categories);
        }
        
        $page = $this->load->view('productsContent', array("produits"=>$produits, "categories"=>array()), TRUE);
        echo $page;
    }

    public function display($id){
        $produit = $this->ProductModel->findById($id);
        if ($produit == null) {
            echo "Produit introuvable."; 
            die();
        }
        $this->load->view("product", array("produit"=>$produit));
    }

}
