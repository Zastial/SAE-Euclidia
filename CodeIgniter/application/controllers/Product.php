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
        $produits = $this->ProductModel->findAllAvailable();
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
            $produits = $this->ProductModel->findAllAvailable();
        } else {
            $produits = $this->ProductModel->findByCategoriesAvailable($categories, true);
        }
        
        $page = $this->load->view('productsContent', array("produits"=>$produits, "categories"=>array()), TRUE);
        echo $page;
    }

    public function display($productid){
        $id = intval($productid);
        $produit = $this->ProductModel->findByIdAvailable($id);
        if ($produit == null) {
            $this->session->set_flashdata('error', 'Le produit sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('product/find');
        }

        $inCart = isset($this->session->cart) && in_array($id, $this->session->cart);
        $this->load->view("product", array("produit"=>$produit, "incart"=>$inCart));

    }

}
