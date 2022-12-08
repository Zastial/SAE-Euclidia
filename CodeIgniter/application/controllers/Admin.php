<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('upload');


        // redirect to home if user is not connected or isn't an admin / responsable
        if (!isset($this->session->user)) {
            redirect('home');
        }

        $status = $this->session->user["status"];
        if ($status != "Responsable" && $status != "Administrateur") {
            redirect('home');
        }

        $this->load->model(array("UserModel", "ProductModel", "CategorieModel", "AffectationModel"));
    }
    
    public function index(){
        $users = $this->UserModel->findAll();
        $products = $this->ProductModel->findAll();
        $categories = $this->CategorieModel->findAll();
        $this->load->view("admin", array('products'=>$products, 'users'=>$users, 'categories'=>$categories));
    }
    
    public function modifUser(int $idUser) {
        $this->form_validation->set_rules('name', 'Name', 'required',
        array('required' => 'Vous devez entrer le nom du produit'));

        $this->form_validation->set_rules('prenom', 'Prenom', 'required',
        array('required' => 'Vous devez entrer le prenom du produit'));

        $this->form_validation->set_rules('email', 'Email', 'required',
        array('required' => 'Vous devez entrer le mail du produit'));

        $user = $this->UserModel->findById($idUser);
        if ($user == null) {
            $this->session->set_flashdata('error', 'L\\\'utilisateur sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('admin');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("modifUser", array("user"=>$user));
        } else {
            $name = $this -> input -> post("name");
            $prenom = $this -> input -> post("prenom");
            $email = $this->input->post("email");
            $password = $this->input->post("password");

            $user -> setNom($name);
            $user -> setPrenom($prenom);
            $user -> setEmail($email);
            $user -> setEncryptedPassword($password);
            
            $this->UserModel->updateUser($user);

            redirect('Admin/index');
        }
    }

    public function removeUser() {

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
            $categories = $this->CategorieModel->findAll();
            $this->load->view("addProduct", array("categories"=>$categories));
        } else {
            
            // form is valid
            $name = $this -> input -> post("name");
            $price = $this -> input -> post("price");
            $description = $this->input->post("description");
            $disponible = $this->input->post("disponible");

            $config["file_name"]= "thumb.png";
            $config['upload_path']= "./../../../../modelassets/";
            $config['allowed_types']='jpg|png';
            $config['max_size']= '2000';
            $config['max_width']= '1024';
            $config['max_height']= '768';
            $this->load->library('upload', $config);
            //$this-> db->insert('post', $_POST);


            if ( ! $this->upload->do_upload("userfile")){
                $error = array('error' => $this->upload->display_errors());

                redirect('Admin/index', $error);
            }else{
                $categories = $this->input->post("categories");

                $product= new ProductEntity ;
                $product -> setTitre($name);
                $product -> setPrix($price);
                $product -> setDescription($description);
                $product -> setDisponible($disponible);

                $this -> ProductModel -> addProduct($product, $categories);

                //COMBO BOX pour les catégories?
                redirect('Admin/index');
            }

            
        }
    }

    public function modifProduct(int $productid) {

        $this->form_validation->set_rules('name', 'Name', 'required',
        array('required' => 'Vous devez entrer le nom du produit'));

        $this->form_validation->set_rules('price', 'Price', 'required',
        array('required' => 'Vous devez entrer le prix du produit'));

        $this->form_validation->set_rules('description', 'Description', 'required',
        array('required' => 'Vous devez entrer la description du produit'));

        $this->form_validation->set_rules('categories[]', 'Categories', 'required',
        array('required' => 'Vous devez entrer la catégorie du produit'));

        $id = intval($productid);
        $produit = $this->ProductModel->findById($id);
        if ($produit == null) {
            $this->session->set_flashdata('error', 'Le produit sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('admin');
        }
        $categories = $this->CategorieModel->findAll();
        $affectations = $this->AffectationModel->findByIdProduct($id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("modifProduct", array("produit"=>$produit, "categories"=>$categories, "affectations" => $affectations));
        } else {
            $name = $this -> input -> post("name");
            $price = $this -> input -> post("price");
            $description = $this->input->post("description");
            $disponible = $this->input->post("disponible");

            $categories = $this->input->post("categories");

            $produit -> setTitre($name);
            $produit -> setPrix($price);
            $produit -> setDescription($description);
            $produit -> setDisponible($disponible);
            
            $this->ProductModel->updateProduct($produit, $categories);

            redirect('Admin/index');
        }
    }

    public function removeProduct(int $productid) {

        $this->ProductModel->removeProduct($productid);

        redirect('Admin/index');
    }


    public function removeCategorie(int $categorieid) {
        $this->CategorieModel->removeCategorie($categorieid);

        redirect('Admin/index');
    }

    public function addCategorie() {
        // redirect to home if user is already connected
        
        $this->form_validation->set_rules('name', 'Name', 'required',
        array('required' => 'Vous devez entrer le nom du produit'));


        if ($this->form_validation->run() == FALSE) {
            $categories = $this->CategorieModel->findAll();
            $this->load->view("addCategorie", array("categories"=>$categories));
        } else {
            
            // form is valid
            $name = $this -> input -> post("name");


            $categorie= new CategorieEntity ;
            $categorie -> setLibelle($name);

            $this -> CategorieModel -> addCategorie($categorie);

            //COMBO BOX pour les catégories?
            redirect('Admin/index');
        }
        
    }

    public function modifCategorie(int $categorieid) {
        $this->form_validation->set_rules('name', 'Name', 'required',
        array('required' => 'Vous devez entrer le nom de la catégorie'));

        $id = intval($categorieid);
        $categorie = $this->CategorieModel->findById($id);
        if ($categorie == null) {
            $this->session->set_flashdata('error', 'La Catégorie sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('admin');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("modifCategorie", array("categorie"=>$categorie));
        } else {
            $name = $this -> input -> post("name");
            
            $categorie -> setLibelle($name);
            
            $this->CategorieModel->updateCategorie($categorie);

            redirect('Admin/index');
        }
    }
}
?>
