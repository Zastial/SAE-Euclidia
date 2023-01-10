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
    
    /**
     * get list of users on admin page
     */
    public function users() {
        $status = $this->session->user["status"];
        //Process filters from inputs
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
        // here we have our final filter, now we can load the view
        $users = $this->UserModel->findQueryBuilder($filtre);
        $this->load->view('admin/dashboardUsers.php', array('users'=>$users, 'active'=>'users'));
    }
    /**
     * get list of categories on admin page
     */
    public function categories() {
        //process input filters
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
        // filters processed, now we can load the view
        $categories = $this->CategorieModel->findQueryBuilder($filtre);
        $this->load->view('admin/dashboardCategories.php', array('categories'=>$categories, 'active'=>'categories'));
    }

    /**
     * get list of products on admin page
     */
    public function products() {
        //process input filters
        $rechercher = $this->input->get('rechercher');
        $tri = $this->input->get('tri');
        $prix = $this->input->get('tri-prix');
        $visible = $this->input->get('tri-visible');

        $filtre = new Filtre();
        if ($rechercher != null && is_string($rechercher)) {
            $filtre = new FiltreName($filtre, $rechercher);
        }

        if ($tri != null && is_string($tri)) {
            $t = Tri::getTriFromString($tri);
            $filtre = new FiltreTri($filtre, $t, 'tri-nom');
        }

        if ($prix != null && is_string($prix)) {
            $t = Tri::getTriFromString($prix);
            $filtre = new FiltreTri($filtre, $t, 'tri');
        }

        if ($visible != null && is_string($visible)) {
            $visible = $visible == "false" ? false : true;
            $filtre = new FiltreAvailable($filtre, $visible);
        }
        // filters processed, now we can load the view
        $products = $this->ProductModel->findQueryBuilder($filtre);
        $this->load->view('admin/dashboardProducts.php', array('products'=>$products, 'active'=>'products'));
    }

    /**
     * get list of bills on admin page
     */
    public function factures($userid=null) {
        $status = $this->session->user["status"];
        //process input filters
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
        // filters processed, now we can load the view
        $factures = $this->FactureModel->findQueryBuilder($filtre, $userid);
        $this->load->view('admin/dashboardBills.php', array('factures'=>$factures, 'active'=>'factures', 'id'=>$userid));
    }

    /**
     * This function is called (at least, should be called) when one sends the form to edit an user.
     */
    public function modifUser(int $idUser) {
        // check if user has the correct rights. While we do this in the class constructor, this is needed here because a "responsable" can't edit users while admins can.
        $status = $this->session->user["status"];
        if ($status != "Administrateur") {
            $this->session->set_flashdata('error', 'Vous n\\\'avez pas les droits nécessaires pour modifier un utilisateur.');
            $url = site_url("admin/users");
            if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
                $url = $_SERVER['HTTP_REFERER'];
            }
            redirect($url);
        }
        //form validation rules.
        $this->form_validation->set_rules('nom', 'Nom', 'required',
        array('required' => 'Vous devez entrer le nom de l utilisateur'));

        $this->form_validation->set_rules('prenom', 'Prenom', 'required',
        array('required' => 'Vous devez entrer le prenom de l utilisateur'));

        $this->form_validation->set_rules('email', 'Email', 'required',
        array('required' => 'Vous devez entrer le mail de l utilisateur'));

        $this->form_validation->set_rules('status', 'Statut', 'required',
        array('required' => 'Vous devez entrer le statut de l utilisateur'));

        $this->form_validation->set_rules('password', 'Mot de passe', 'max_length[50]|callback_isValidModifyPassword',
            array('max_length' => 'Le mot de passe ne doit pas dépasser 50 caractères', 'isValidModifyPassword' => 'Le mot de passe actuel n\'est pas assez sécurisé'));

        $user = $this->UserModel->findById($idUser);
        if ($user == null) {
            $this->session->set_flashdata('error', 'L\\\'utilisateur sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('admin/users');
        }
        //Even if an admin, one should not be able to edit his own account!
        if ($this->session->user['email']==$user->getEmail()){
            $this->session->set_flashdata('error', 'Vous ne pouvez pas modifier votre compte ici !');
            $url = site_url("admin/users");
            if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
                $url = $_SERVER['HTTP_REFERER'];
            }
            redirect($url);
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("admin/modifUser.php", array("user"=>$user));
        } else {
            // get form inputs
            $name = $this -> input -> post("nom");
            $prenom = $this -> input -> post("prenom");
            $email = $this->input->post("email");
            $password = $this->input->post("password");
            $status = $this->input->post("status");

            $user->setNom($name);
            $user->setPrenom($prenom);
            $user->setEmail($email);

            if (!empty($password)) {
                $user->setEncryptedPassword($password);
            }
            //factory
            $u = UserEntity::getUser($status);
            if ($u==null){
                $this->session->set_flashdata('error', 'Statut invalide!');
                redirect('Admin/users');
            }

            $u->setNom($user->getNom());
            $u->setId($user->getId());
            $u->setPrenom($user->getPrenom());
            $u->setEmail($user->getEmail());
            $u->setEtat($user->getEtat());
            $u->setPassword($user->getPassword());
            $u->setNom($user->getNom());
            $u->setNumRue($user->getNumRue());
            $u->setAdresse($user->getAdresse());
            $u->setVille($user->getVille());
            $u->setPostalCode($user->getPostalCode());
            $u->setPays($user->getPays());

            if ($this->UserModel->updateUser($u) == null) {
                $this->session->set_flashdata('error', 'L\\\'utilisateur n\\\'a pas pu être modifié.');
            } else {
                $this->session->set_flashdata('success', 'L\\\'utilisateur a bien été modifié.');
            }
            
            redirect('Admin/users');
        }
    }

    /**
     * Check if password is valid (???)
     */
    public function isValidModifyPassword(string $pass=null) {
        if ($pass == null || $pass == "") {
            return true;
        }
        return $this->isValidPassword($pass);
    }

     /**
     * @param string $name
     * @return bool
     * checks is password is valid (at least 1 uppercase, 1 lowercase, 1 number, 1 special char, 5 chars min, 20 chars max)
     */
    public function isValidPassword(string $pass=null): bool {
        if ($pass==null) {
            return false;
        }
        $uppercase=preg_match('@[A-Z]@',$pass);
        $lowercase=preg_match('@[a-z]@',$pass);
        $number=preg_match('@[0-9]@',$pass);
        $specialChars=preg_match('@[^\w]@',$pass);
        return $uppercase && $lowercase && $number && $specialChars;
    }


    /**
     * This function is called when adding a product using an AJAX form. This won't work if the form isn't AJAX.
     */
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

            // if we have errors with text inputs, add them to the array
           
            if (!isset($name)) {
                $errors['name'] = "Le nom du produit n'est pas défini !";
            }
            if (!isset($price)) {
                $errors['price'] = "Le prix du produit n'est pas défini !";
            }else {
                $price = floatval($price);
                if ($price < 0 || $price >= 10000) {
                    $errors['price'] = 'Le prix doit être compris entre 0 et 9 999.99€ compris';
                }
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
            
            // if we have no error, we proceed to create the product
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
                    //Codeigniter n'a pas de fonction pour upload l'array $_FILES['userfiles'].
                    $cpt=count($files['userfile']['name']);
                    for ($i=0;$i<$cpt;$i++){ //On doit donc faire en sorte que pour chaque fichier,
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

        // if we have no errors, redirect to product with success message
        // $errors should only contain one element: image
        // image should be an empty array
        if (count($errors) == 1 && empty($errors['image'])) {
            $status = "success";
            $this->session->set_flashdata('success', 'Le produit a été correctement ajouté !');
        }
        $data = array(
            $errors,
            $status,
        );
        echo json_encode($data);
    }

    public function addProduct(){
        $categories = $this->CategorieModel->findAll();
        $this->load->view("admin/addProduct", array("categories"=>$categories));
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

        $this->form_validation->set_rules('disponible', 'Disponible', 'required',
        array('required' => 'Vous devez entrer la disponibilité du produit'));

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
            $name = $this->input->post("name");
            $price = floatval($this->input->post("price"));
            $description = $this->input->post("description");
            $disponible = $this->input->post("disponible");

            $categories = $this->input->post("categories");

            $produit->setTitre($name);
            $produit->setPrix($price);
            $produit->setDescription($description);
            $produit->setDisponible($disponible=="oui");
            
            if (!isset($categories)) {
                $categories = array();
            }
            if($this->ProductModel->updateProduct($produit, $categories)) {
                if ($price>9999.99){
                    $this->session->set_flashdata('warning', 'Le produit a été modifié, mais le prix a été tronqué a 9999.99€ car il était trop haut!');
                } else {
                    $this->session->set_flashdata('success', 'Le produit a bien été modifié !');
                }
            } else {
                $this->session->set_flashdata('error', 'Le produit n\\\'a pas pu être modifié.');
            }

            redirect('Admin/products');
        }
    }
    
     
    /*
    public function removeProduct(int $productid) { //NEVER DO THAT

        $this->ProductModel->removeProduct($productid);

        redirect('Admin/products');
    }*/

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

    public function toggleActivation(int $userid){
        $status = $this->session->user["status"];
        if ($status != "Administrateur") {
            $this->session->set_flashdata('error', 'Vous n\\\'avez pas les droits nécessaires pour modifier l\\\'état d\\\'un utilisateur.');
            $url = site_url("admin/users");
            if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
                $url = $_SERVER['HTTP_REFERER'];
            }
            redirect($url);
        }
        $u = $this->UserModel->findById($userid);
        if ($u == null) {
            $this->session->set_flashdata('error', 'L\\\'utilisateur n\\\'existe plus!');
            redirect('admin/users');
        }
        if ($this->session->user['email']==$u->getEmail()){
            $this->session->set_flashdata('error', 'Vous ne pouvez pas désactiver votre compte!');
            redirect('admin/users');
        }
        $u->setEtat($u->getEtat()=="active"?"desactive":"active");
        $this->UserModel->activeUser($u);
        redirect('Admin/users');
    }
    
    public function removeCategorie(int $categorieid) {
        $success = $this->CategorieModel->removeCategorie($categorieid);
        if (!$success) {
            $this->session->set_flashdata('error', 'La catégorie n\\\'a pas pu être supprimée.');
        } else {
            $this->session->set_flashdata('success', 'La catégorie a bien été supprimée.');
        }
        redirect('Admin/categories');
    }

    public function addCategorie() {
        
        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[categorie.libelle]',
        array('required' => 'Vous devez entrer le nom du produit', 'is_unique'=>'Ce nom de catégorie existe déjà.'));


        if ($this->form_validation->run() == FALSE) {
            $this->load->view("/admin/addCategorie.php");
        } else {
            
            // form is valid
            $name =$this->input->post("name");


            $categorie= new CategorieEntity ;
            $categorie -> setLibelle($name);

            if ($this->CategorieModel->addCategorie($categorie)) {
                $this->session->set_flashdata('success', 'La catégorie a bien été ajoutée !');
            }else {
                $this->session->set_flashdata('error', 'La catégorie n\\\'a pas pu être ajoutée.');
            }
            
            redirect('Admin/categories');
        }
        
    }

    public function modifCategorie(int $categorieid) {
        $this->form_validation->set_rules('name', 'Name', 'required',
        array('required' => 'Vous devez entrer le nom de la catégorie'));

        $this->form_validation->set_rules('name', 'Name', 'required|is_unique[categorie.libelle]',
        array('required' => 'Vous devez entrer le nom du produit', 'is_unique'=>'Ce nom de catégorie existe déjà.'));

        $id = intval($categorieid);
        $categorie = $this->CategorieModel->findById($id);
        if ($categorie == null) {
            $this->session->set_flashdata('error', 'La catégorie sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('admin/categories');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("admin/modifCategorie", array("categorie"=>$categorie));
        } else {
            $name = $this -> input -> post("name");
            
            $categorie -> setLibelle($name);
            
            $this->CategorieModel->updateCategorie($categorie);

            redirect('Admin/categories');
        }
    }


}
?>
