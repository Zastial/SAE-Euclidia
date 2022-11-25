<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');


        // redirect to home if user is not connected or isn't an admin / responsable
        if (!isset($this->session->user)) {
            redirect('home');
        }

        $status = $this->session->user["status"];
        if ($status != "Responsable" && $status != "Administrateur") {
            redirect('home');
        }

        $this->load->model(array("UserModel", "ProductModel", "CategorieModel"));
    }
    
    public function index(){
        $users = $this->UserModel->findAll();
        $products = $this->ProductModel->findAll();
        $categories = $this->CategorieModel->findAll();
        $this->load->view("admin", array('products'=>$products, 'users'=>$users, 'categories'=>$categories));
    }
    
    public function removeUser() {

    }

    public function addUser() {

    }

    public function removeProduct() {

    }

    public function addProduct(){
        // redirect to home if user is already connected
        
        $this->form_validation->set_rules('name', 'Name', 'required',
            array('required' => 'Vous devez entrer le nom du produit'));

        $this->form_validation->set_rules('price', 'Price', 'required',
        array('required' => 'Vous devez entrer le prix du produit'));

        $this->form_validation->set_rules('description', 'Description', 'required',
        array('required' => 'Vous devez entrer la description du produit'));


        if ($this->form_validation->run() == FALSE) {
            $this->load->view("addProduct");
        } else {
            
            // form is valid
            $name = $this -> input -> post("name");
            $price = $this -> input -> post("price");
            $description = $this->input->post("description");
           
            
            if ($this->input->post("disponible")=="true"){
                $disponible= true;
            }else{
                $disponible= false;
            }

            $product= new ProductEntity ;
            $product -> setTitre($name);
            $product -> setPrix($price);
            $product -> setDescription($description);
            $product -> setDisponible($disponible);

            $this -> ProductModel -> addProduct($product);

            //COMBO BOX pour les catégories?
            redirect('Admin/index');
        }
    }

    public function removeCategorie() {

    }

    public function addCategorie() {
        
    }
}
?>