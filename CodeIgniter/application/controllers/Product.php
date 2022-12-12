<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("ProductModel");
        $this->load->model("CategorieModel");
        $this->load->model("UserModel");
        $this->load->model("AchatModel");
        $this->load->helper("url");
    }
    
    public function find(){
        $categories = $this->input->get('categorie');
        $name = $this->input->get('rechercher');
        $tri = $this->input->get('tri');
        $minprice = $this->input->get('price-min');
        $maxprice = $this->input->get('price-max');

        if (!is_numeric($minprice)) {
            $minprice = 0;
        }
        if (!is_numeric($maxprice)) {
            $maxprice = 9999;
        }
        
        $produits = $this->ProductModel->findQueryBuilder(
            $name, $categories, $tri, $minprice, $maxprice, true
        );

        $categories = $this->CategorieModel->findAll();
        $this->load->view("products", array("produits"=>$produits, "categories"=>$categories));
    }

    public function display($productid){
        $id = intval($productid);
        $produit = $this->ProductModel->findByIdAvailable($id);
        if ($produit == null) {
            $this->session->set_flashdata('error', 'Le produit sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('product/find');
        }
        
        $isProductBought = false;
        if (isset($this->session->user)) {
            $email = $this->session->user['email'];
            $isProductBought = $this->AchatModel->boughtFromUser($productid, $email);
        }

        $path = $this->config->item('model_assets') . $productid;
        $c=0;
        if (is_dir($path)) {
            $files = scandir($path);
            array_splice($files, 0, 2);
    
            $c = count($files);
        }

        $inCart = isset($this->session->cart) && in_array($id, $this->session->cart);
        $this->load->view("product", array("produit"=>$produit, "incart"=>$inCart, "isbought"=>$isProductBought, "c"=>$c));

    }

}
