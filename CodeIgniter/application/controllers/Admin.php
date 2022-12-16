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
            $categories = $this->input->post("categories");
            if ($categories == null) {
                $categories = array();
            }
            $product= new ProductEntity;
            $product -> setTitre($name);
            $product -> setPrix($price);
            $product -> setDescription($description);
            $product -> setDisponible($disponible);
            $prod = $this -> ProductModel -> addProduct($product, $categories);
            $id = $prod->getId();
            $this->load->library('upload');

            $files=$_FILES;
            $cpt=count($_FILES['userfile']['name']);
            for ($i=0;$i<$cpt;$i++){
                $ext = pathinfo($files['userfile']['name'][$i], PATHINFO_EXTENSION);
                $filename = $i.'.'.$ext;
                $_FILES['userfile']['name']= $filename;
                $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                $_FILES['userfile']['size']= $files['userfile']['size'][$i];
                $this->upload->initialize($this->set_upload_options($i, $filename, $id, "png|jpg"));
                $this->upload->do_upload('userfile');
                // print_r($this->upload->display_errors());
                
            }
            
            $cpt=count($_FILES['models']['name']);
            $za = new ZipArchive();
            $zname = $this->config->item('model_assets') . $id;
            if (!is_dir($zname)){
                mkdir($zname, 0755, TRUE);
            }
            $zname .= "/models.zip";
            if ($za->open($zname, ZipArchive::CREATE) !== TRUE) {
                $this->session->set_flashdata('error', 'La création du zip a échoué!');
                redirect("admin");
            }
            for ($i=0;$i<$cpt;$i++){
                $exp = explode('.', $files['models']['name'][$i]);
                $ext = end($exp);
                $supported_file_types = array("glb", "gltf", "3ds", "stl", "mtl", "obj");
                if (in_array($ext, $supported_file_types))$za->addFromString($files['models']['name'][$i], file_get_contents($_FILES['models']['tmp_name'][$i]));
                //move_uploaded_file($_FILES['img']['tmp_name'][$i], './uploads/' . $files['models']['name'][$i]);

            }
            $za->close();

            //COMBO BOX pour les catégories?
            redirect('Admin/index');
            
        }
    }

    private function set_upload_options($i=0, $str="none.jpg", $id=0, $types="png"){
        $path = $this->config->item('model_assets') . $id;
        if (!is_dir($path)){
            mkdir($path, 0755, TRUE);
        }
        $config ['file_name']= $str;
        $config ['upload_path'] = $path;
        $config ['allowed_types'] = $types;
        $config ['encrypt_name'] = FALSE;

        return $config;
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

    public function removeProduct(int $productid) { //NEVER DO THAT

        $this->ProductModel->removeProduct($productid);

        redirect('Admin/index');
    }

    public function toggleVisibility(int $productid){
        $p = $this->ProductModel->findById($productid);
        if ($p == null) {
            $this->session->set_flashdata('error', 'Le produit sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('admin');
        }
        $p->setDisponible(!$p->getDisponible());
        $this->ProductModel->updateProduct($p, array());
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
            $this->load->view("/admin/addCategorie.php", array("categories"=>$categories));
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
