<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();


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

    public function addProduct() {

    }

    public function removeCategorie() {

    }

    public function addCategorie() {
        
    }
}
?>