<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShoppingCart extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("ProductModel");
        $this->load->library('user_agent');

        if (!isset($this->session->cart)) {
            $this->session->set_userdata("cart",array());
        }
    }

    public function index(){
        $produits = array();
        foreach ($this->session->cart as $id) {
            $prod = $this->ProductModel->findById($id);
            if ($prod != null) {
                $produits[] = $prod;
            }
        }

        $this->load->view("shoppingCart", array('produits'=>$produits));
    }

    public function addProduct($id=null){
        $produit = $this->ProductModel->findById($id);
        if ($produit == null) {
            echo "Produit non trouvé";
            die();
        }
        $cart = $this->session->cart;
        if (!in_array($id, $cart)) {
            $cart[] = $id;
            $this->session->set_userdata("cart",$cart);
        }
        
        redirect($this->agent->referrer());
        
    }

    public function removeProduct($id=null){
        $cart = $this->session->cart;
        foreach ($cart as $key => $value) {
            if ($value == $id) {
                unset($cart[$key]);
            }
        }
        $this->session->set_userdata("cart",$cart);
        redirect($this->agent->referrer());
    }

    
}

   





?>