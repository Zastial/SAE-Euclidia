<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."Filtre.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltreAvailable.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltrePrice.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltreTri.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltrePage.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltreCategories.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltreName.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltreDate.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."Tri.php";
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

        $this->load->model(array("UserModel", "ProductModel", "CategorieModel", "AffectationModel", "FactureModel"));
    }
    
    public function index(){
        $this->load->view('admin/dashboard.php');
    }
    
    public function users() {
        $status = $this->session->user["status"];
        if ($status != "Administrateur") {
            redirect('admin');
        }
        $rechercher = $this->input->get('rechercher');
        $tri = $this->input->get('tri');
        $triStatus = $this->input->get('tri-status');
        $triEtat = $this->input->get('tri-etat');

        $filtre = new Filtre();
        if ($rechercher != null && is_string($rechercher)) {
            $filtre = new FiltreName($filtre, $rechercher);
        }

        if ($tri != null && is_string($tri)) {
            $t = Tri::getTriFromString($tri);
            $filtre = new FiltreTri($filtre, $t);
        }

        if ($triStatus != null && is_string($triStatus)) {
            $t = Tri::getTriFromString($triStatus);
            $filtre = new FiltreTri($filtre, $t, 'status');
        }
        
        if ($triEtat != null && is_string($triEtat)) {
            $t = Tri::getTriFromString($triEtat);
            $filtre = new FiltreTri($filtre, $t, 'etat');
        }
        $users = $this->UserModel->findQueryBuilder($filtre);
        $this->load->view('admin/dashboardUsers.php', array('users'=>$users, 'active'=>'users'));
    }

    public function categories() {
        $status = $this->session->user["status"];
        if ($status != "Responsable" && $status != "Administrateur") {
            redirect('admin');
        }
        $tri = $this->input->get('tri-categ');
        $rechercher = $this->input->get('rechercher');

        $filtre = new Filtre();
        if ($rechercher != null && is_string($rechercher)) {
            $filtre = new FiltreName($filtre, $rechercher);
        }

        if ($tri != null && is_string($tri)) {
            $t = Tri::getTriFromString($tri);
            $filtre = new FiltreTri($filtre, $t);
        }
        
        $categories = $this->CategorieModel->findQueryBuilder($filtre);
        $this->load->view('admin/dashboardCategories.php', array('categories'=>$categories, 'active'=>'categories'));
    }

    public function products() {
        $status = $this->session->user["status"];
        if ($status != "Responsable" && $status != "Administrateur") {
            redirect('admin');
        }
        $products = $this->ProductModel->findAll();
        $this->load->view('admin/dashboardProducts.php', array('products'=>$products, 'active'=>'products'));
    }

    public function factures($userid=null) {
        $status = $this->session->user["status"];
        if ($status != "Responsable" && $status != "Administrateur") {
            redirect('admin');
        }
        
        $triId = $this->input->get('tri-id');
        $triPrix = $this->input->get('tri-prix');
        $triDate = $this->input->get('tri-date');
        $id = $this->input->get('user-id');
        $minDate = $this->input->get('minDate');
        $maxDate = $this->input->get('maxDate');

        if ($id != null) {
            $userid = $id;
        }

        $filtre = new Filtre();

        if (isset($triId)){
            $tri = Tri::getTriFromString($triId);
            $filtre = new FiltreTri($filtre, $tri);
        }
        if (isset($triPrix)) {
            $tri = Tri::getTriFromString($triPrix);
            $filtre = new FiltreTri($filtre, $tri, 'prix');
        }
        if (isset($triDate)) {
            $tri = Tri::getTriFromString($triDate);
            $filtre = new FiltreTri($filtre, $tri, 'date');
        }

        if (isset($minDate) && isset($maxDate)) {
            $filtre = new FiltreDate($filtre, $minDate, $maxDate);
        }

        $factures = $this->FactureModel->findQueryBuilder($filtre, $userid);
        $this->load->view('admin/dashboardBills.php', array('factures'=>$factures, 'active'=>'factures', 'id'=>$userid));
    }

    public function modifUser(int $idUser) {
        $this->form_validation->set_rules('nom', 'Nom', 'required',
        array('required' => 'Vous devez entrer le nom de l utilisateur'));

        $this->form_validation->set_rules('prenom', 'Prenom', 'required',
        array('required' => 'Vous devez entrer le prenom de l utilisateur'));

        $this->form_validation->set_rules('email', 'Email', 'required',
        array('required' => 'Vous devez entrer le mail de l utilisateur'));

        $user = $this->UserModel->findById($idUser);
        if ($user == null) {
            $this->session->set_flashdata('error', 'L\\\'utilisateur sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('admin/users');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("admin/modifUser.php", array("user"=>$user));
        } else {
            $name = $this -> input -> post("nom");
            $prenom = $this -> input -> post("prenom");
            $email = $this->input->post("email");
            $password = $this->input->post("password");

            $user -> setNom($name);
            $user -> setPrenom($prenom);
            $user -> setEmail($email);
            $user -> setEncryptedPassword($password);
            
            $this->UserModel->updateUser($user);

            redirect('Admin/users');
        }
    }

    public function removeUser() {
        //DO NOT
    }

    public function addProductAjax() {

        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        $status = $this->session->user["status"];
        $isAllowed = $status == "Responsable" || $status == "Administrateur";
        $errors = array();
        $status = "";

        if ($isAjax && $isAllowed) {

            $name = $this->input->post("name");
            $price = $this->input->post("price");
            $description = $this->input->post("description");
            $disponible = $this->input->post("disponible");
            $categories = $this->input->post("categories");

            // text input errors
           
            if (!isset($name)) {
                $errors['name'] = "Le nom du produit n'est pas défini !";
            }
            if (!isset($price)) {
                $errors['price'] = "Le prix du produit n'est pas défini !";
            }
            if (!isset($description)) {
                $errors['description'] = "La description du produit n'est pas définie !";
            }
            if (!isset($disponible)) {
                $errors['available'] = "La disponibilité du produit n'est pas définie !";
            }
            if (!isset($categories)) {
                $categories = array();
            }
            
            if (empty($errors)) {
                // create product
                $product= new ProductEntity;
                $product->setTitre($name);
                $product->setPrix($price);
                $product->setDescription($description);
                $product->setDisponible($disponible);
                $prod = $this->ProductModel->addProduct($product, $categories);

                if ($prod == null) {
                    $errors['product'] = "Le produit n'a pas pu être créé. Veuillez réessayer ou contacter l'administrateur du système.";
                } else {
                    
                    $id = $prod->getId();
                    $this->load->library('upload');
                    // upload images
                    $errors['image'] = array();

                    $files=$_FILES;

                    if (!isset($files)) {
                        $files = array();
                    }
                    $cpt=count($files['userfile']['name']);
                    for ($i=0;$i<$cpt;$i++){
                        $ext = pathinfo($files['userfile']['name'][$i], PATHINFO_EXTENSION);
                        $filename = $i.'.'.$ext;
                        $_FILES['userfile']['name']= $filename;
                        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                        $_FILES['userfile']['size']= $files['userfile']['size'][$i];
                        $this->upload->initialize($this->set_upload_options($i, $filename, $id, "png|jpg|jpeg"));

                        if(!$this->upload->do_upload('userfile')) {
                            $errors['image'][] = $i;
                        }
                    }

                    // upload zip
                    $cpt=count($_FILES['models']['name']);
                    $za = new ZipArchive();
                    $zname = $this->config->item('model_assets') . $id;
                    if (!is_dir($zname)){
                        mkdir($zname, 0755, TRUE);
                    }
                    $zname .= "/models.zip";
                    if ($za->open($zname, ZipArchive::CREATE) !== TRUE) {
                        $this->session->set_flashdata('error', 'La création du zip a échoué!');
                        redirect("admin/products");
                    }
                    for ($i=0;$i<$cpt;$i++){
                        $exp = explode('.', $files['models']['name'][$i]);
                        $ext = end($exp);
                        $supported_file_types = array("glb", "gltf", "3ds", "stl", "mtl", "obj");
                        if (in_array($ext, $supported_file_types)) {
                            $za->addFromString($files['models']['name'][$i], file_get_contents($_FILES['models']['tmp_name'][$i]));
                        } else {
                            $errors['zip'][] = $files['models']['name'][$i];
                        }
                    }
                    $za->close();

                    // if we had errors uploading images or zip file, delete the directory and the product
                    if (!empty($errors['image']) || !empty($errors['zip'])) {
                        $path = $this->config->item('model_assets') . $id;
                        $this->load->helper("file"); 
                        delete_files($path, true); 
                        rmdir($path);
                        $this->ProductModel->removeProduct($id);
                    }

                }
            }
        }

        // if we have no errors
        if (count($errors) == 1 && empty($errors[0])) {
            $status = "success";
        }
        $data = array(
            $errors,
            $status
        );
        echo json_encode($data);
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
            $this->load->view("admin/addProduct", array("categories"=>$categories));
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
            $errors=array();
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
                $this->upload->initialize($this->set_upload_options($i, $filename, $id, "png|jpg|jpeg"));
                $success=$this->upload->do_upload('userfile');
                if (!$success){
                    $errors[] = $filename;
                    $e = $this->upload->display_errors();
                    log_message('debug', $e);
                    $this->load->view("admin/addProduct", array("categories"=>$categories));
                    return;
                }
                
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
                redirect("admin/products");
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
            if (count($errors)>0){
                $imgerrs="";
                foreach($errors as $fail){
                    $imgerrs.=$fail;
                }
                
                $this->session->set_flashdata('error', 'Les images suivantes ne passent pas:'.$imgerrs);
            }
            redirect('Admin/products');
            
        }
    }

    private function set_upload_options($i=0, $str="none.jpg", $id=0, $types="png|jpg|jpeg"){
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

        $id = intval($productid);
        $produit = $this->ProductModel->findById($id);
        if ($produit == null) {
            $this->session->set_flashdata('error', 'Le produit sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('admin/products');
        }
        $categories = $this->CategorieModel->findAll();
        $affectations = $this->CategorieModel->findByModelId($id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("admin/modifProduct", array("produit"=>$produit, "categories"=>$categories, "affectations" => $affectations));
        } else {
            $name = $this -> input -> post("name");
            $price = $this -> input -> post("price");
            $description = $this->input->post("description");
            $disponible = $this->input->post("disponible");

            $categories = $this->input->post("categories");

            $produit->setTitre($name);
            $produit->setPrix($price);
            $produit->setDescription($description);
            $produit->setDisponible($disponible);
            
            if (!isset($categories)) {
                $categories = array();
            }
            $this->ProductModel->updateProduct($produit, $categories);
        

            redirect('Admin/products');
        }
    }

    public function removeProduct(int $productid) { //NEVER DO THAT

        $this->ProductModel->removeProduct($productid);

        redirect('Admin/products');
    }

    public function toggleVisibility(int $productid){
        $p = $this->ProductModel->findById($productid);
        if ($p == null) {
            $this->session->set_flashdata('error', 'Le produit sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('admin/products');
        }
        $p->setDisponible(!$p->getDisponible());
        $this->ProductModel->updateProduct($p, array());
        redirect('Admin/products');
    }
    
    public function removeCategorie(int $categorieid) {
        $this->CategorieModel->removeCategorie($categorieid);

        redirect('Admin/categories');
    }

    public function addCategorie() {
        
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

            redirect('Admin/categories');
        }
        
    }

    public function modifCategorie(int $categorieid) {
        $this->form_validation->set_rules('name', 'Name', 'required',
        array('required' => 'Vous devez entrer le nom de la catégorie'));

        $id = intval($categorieid);
        $categorie = $this->CategorieModel->findById($id);
        if ($categorie == null) {
            $this->session->set_flashdata('error', 'La Catégorie sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('admin/categories');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("modifCategorie", array("categorie"=>$categorie));
        } else {
            $name = $this -> input -> post("name");
            
            $categorie -> setLibelle($name);
            
            $this->CategorieModel->updateCategorie($categorie);

            redirect('Admin/categories');
        }
    }


}
?>
