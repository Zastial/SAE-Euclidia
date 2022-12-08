<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("UserModel");
        $this->load->model("FactureModel");
        $this->load->model("AchatModel");
        $this->load->model("ProductModel");
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function register() {
        // redirect to home if user is already connected
        if (isset($this->session->user)) {
            redirect('Home');
            die();
        }
        
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|callback_isValidName|max_length[50]',
            array('required' => 'Vous devez entrer un prénom', 'isValidName' => 'Le prénom ne doit contenir que des lettres', 'max_length' => 'Le prénom ne doit pas dépasser 50 caractères'));

        $this->form_validation->set_rules('nom', 'Nom', 'required|callback_isValidName|max_length[50]',
            array('required' => 'Vous devez entrer un nom', 'isValidName' => 'Le nom ne doit contenir que des lettres', 'max_length' => 'Le nom ne doit pas dépasser 50 caractères'));

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[utilisateur.email]',
            array('required' => 'Vous devez entrer un email', 'valid_email' => 'L\'email n\'est pas valide', 'is_unique' => 'L\'email est déjà utilisé'));

        $this->form_validation->set_rules('password', 'Mot de passe', 'required|callback_isValidPassword|min_length[8]|max_length[50]',
            array('required' => 'Vous devez entrer un mot de passe', 'isValidPassword' => 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial', 'min_length' => 'Le mot de passe doit contenir au moins 8 caractères', 'max_length' => 'Le mot de passe ne doit pas dépasser 50 caractères'));

        $this->form_validation->set_rules('confirm-password', 'Confirmation du mot de passe', 'required|matches[password]',
            array('required' => 'Vous devez confirmer le mot de passe', 'matches' => 'Les mots de passe ne correspondent pas'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("inscription");
        } else {
            
            // form is valid
            
            $nom = $this->input->post("nom");
            $prenom = $this->input->post("prenom");
            $email = $this->input->post("email");
            $password = $this->input->post("password");
            $status = "Utilisateur";

            $user = new UserEntity();

            $user->setNom(htmlspecialchars($nom));
            $user->setPrenom(htmlspecialchars($prenom));
            $user->setEmail(htmlspecialchars($email));
            $user->setEncryptedPassword(htmlspecialchars($password));
            $user->setStatus($status);

            // add user to database, returns null if it didn't work
            $user = $this->UserModel->addUser($user);
            
            if ($user == null) {
                $this->session->set_flashdata('error', 'Erreur dans l\'inscription ! Veuillez réessayer.');
                redirect('User/register');
            }
            
            $this->session->set_flashdata('success', 'Inscription réussie! Vous pouvez maintenant vous connecter.');
            redirect('User/login');
        }
    }



    public function login() {
        // redirect to home if user is already connected
        if (isset($this->session->user)) {
            redirect('Home');
            die();
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email',
            array('required' => 'Vous devez entrer un email', 'valid_email' => 'L\'email n\'est pas valide'));

        $this->form_validation->set_rules('password', 'Mot de passe', 'required',
            array('required' => 'Vous devez entrer un mot de passe'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("connexion");
        } else {
            
            // form is valid
            $email = $this->input->post("email");
            $password = $this->input->post("password");

            $user = $this->UserModel->findByEmail($email);
            
            if ($user == null || !$user->isValidPassword($password)) {
                $this->session->set_flashdata('error', 'Identifiant ou mot de passe incorrect.');
                redirect('User/login');
            } 

            $this->session->set_userdata("user",array(
                "nom"=>$user->getNom(),
                "prenom"=>$user->getPrenom(),
                "email"=>$user->getEmail(), 
                "status"=>$user->getStatus()));
            
            redirect('Home');
        }
    }

    public function logout() {
        $this->session->unset_userdata("user");
        $this->session->unset_userdata("cart");
		$this->session->sess_destroy();
        redirect('Home');
    }

    public function modify() {
        // redirect to home if user is not connected
        if (!isset($this->session->user)) {
            redirect('Home');
            die();
        }

        $this->form_validation->set_rules('prenom', 'Prénom', 'required|callback_isValidName|max_length[50]',
            array('required' => 'Vous devez entrer un prénom', 'isValidName' => 'Le prénom doit démarrer par une lettre et ne doit contenir que des lettres ou les caractères -\'', 'max_length' => 'Le prénom ne doit pas dépasser 50 caractères'));

        $this->form_validation->set_rules('nom', 'Nom', 'required|callback_isValidName|max_length[50]',
            array('required' => 'Vous devez entrer un nom', 'isValidName' => 'Le nom doit démarrer par une lettre et ne doit contenir que des lettres ou les caractères -\'', 'max_length' => 'Le nom ne doit pas dépasser 50 caractères'));

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_isUniqueEmail',
            array('required' => 'Vous devez entrer un email', 'valid_email' => 'L\'email n\'est pas valide', 'isUniqueEmail' => 'L\'email est déjà utilisé'));

        $this->form_validation->set_rules('new-password', 'Mot de passe', 'max_length[50]|callback_isValidModifyPassword',
            array('max_length' => 'Le mot de passe ne doit pas dépasser 50 caractères', 'isValidModifyPassword' => 'Votre mot de passe actuel est incorrect!'));

        $this->form_validation->set_rules('confirm-new-password', 'Confirmation du mot de passe', 'matches[new-password]',
            array('matches' => 'Les mots de passe ne correspondent pas'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("modifyAccount");
        } else {

            // form is valid
            $email = $this->input->post("email");
            $nom = $this->input->post("nom");
            $prenom = $this->input->post("prenom");
            $actualPassword = $this->input->post("password");
            $newPassword = $this->input->post("new-password");

            $user = $this->UserModel->findByEmail($email);
            if ($user == null) {
                $this->session->set_flashdata('error', 'Une erreur est survenue. Vous allez être déconnecté.');
                $this->logout();
            }

            if (!$user->isValidPassword($actualPassword)) {
                $this->session->set_flashdata('error', 'Le mot de passe actuel que vous avez entré est invalide.');
                redirect('user/modify');
            }
            
            $user->setNom($nom);
            $user->setPrenom($prenom);
            $user->setEmail($email);

            if (!empty($newPassword)) {
                $user->setEncryptedPassword($newPassword);
            }

            $newuser = $this->UserModel->updateUser($user);

            if ($newuser == null){            
                $this->session->set_flashdata('error', 'Une erreur est survenue. Vous allez être déconnecté.');
                $this->logout();
            }

            // update user in session
            $this->session->set_userdata("user",array(
                "nom"=>$newuser->getNom(),
                "prenom"=>$newuser->getPrenom(),
                "email"=>$newuser->getEmail(), 
                "status"=>$newuser->getStatus()));
            
            $this->session->set_flashdata('success', 'Opération réalisée avec succès !');
            redirect('User/account');
        }
    }

    public function isValidModifyPassword(string $pass=null) {
        if ($pass == null || $pass == "") {
            return true;
        }
        return $this->isValidPassword($pass);
    }

    /**
     * @param string $email
     * @return bool
     * returns true if email is unique
     * if email is the same as the current user's email, returns true
     */
    public function isUniqueEmail(string $email=null) {
        if ($email==null) {
            return false;
        }
        $user = $this->UserModel->findByEmail($email);
        if ($user==null) {
            return true;
        }
        if (!isset($this->session->user["email"])) {
            return false;
        }
        return $this->session->user["email"] == $email;     
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
     * @param string $name
     * @return bool
     * checks if name is valid (no numbers, 50 chars max)
     */
    public function isValidName(string $name): bool {
        preg_match("@(?i)[a-zÀ-ÿ'-]+@", $name, $matches);
        if (count($matches) == 0) return false;
        preg_match("@(?i)[a-zÀ-ÿ]@", $name[0], $matches2);
        if (count($matches2) == 0) return false;
        return strlen($matches[0]) == strlen($name);
    }

    public function account() {
        // redirect to home if user is not connected
        if (!isset($this->session->user)) {
            redirect('Home');
        }
        $user = $this->UserModel->findByEmail($this->session->user["email"]);
        if (is_null($user)) redirect("User/login");
        $factures = $this->FactureModel->findByUser($user->getId());
        $this->load->view("account", array("factures" => $factures, "user"=>$user));
    }

    public function getFacture($id){
        $f = $this->FactureModel->findById($id);
        if (is_null($f)) redirect('User/account');
        $u = $this->UserModel->findById($f->getUserId());
        if ($u->getId() != $this->UserModel->findByEmail($this->session->user["email"])->getId()) redirect('User/account');
        $a = $this->AchatModel->findById($id);
        $arr = array();
        foreach ($a as $ent){
            $p = $this->ProductModel->findById($ent->getIdProduit());
            if (!is_null($p)){
                $arr[] = array($p->getTitre(), $ent->getPrix());
            }
        }
        $this->load->view("facture", array("f" => $f, "u" =>$u, "a"=>$arr));
        
    }

    public function modifyAddress(){
        if (!isset($this->session->user)) {
            redirect('Home');
            die();
        }

        $this->form_validation->set_rules('numerorue', 'Numéro de rue', 'required|max_length[6]',
            array('required' => 'Vous devez entrer un numéro', 'max_length' => 'Le numéro de rue ne doit pas dépasser 6 caractères'));

        $this->form_validation->set_rules('adresse', 'Adresse', 'required|max_length[300]',
            array('required' => 'Vous devez entrer une adresse', 'max_length' => 'L\'adresse ne doit pas dépasser 300 caractères'));

        $this->form_validation->set_rules('ville', 'Ville', 'required|max_length[50]',
            array('required' => 'Vous devez entrer un email', 'max_length' => 'Le nom de la ville ne doit pas dépasser 50 caractères'));

        $this->form_validation->set_rules('codepostal', 'Code Postal', 'required|max_length[5]',
            array('required' => 'Vous devez entrer un email', 'max_length' => 'Le code postal de passe ne doit pas dépasser 5 caractères'));

        $this->form_validation->set_rules('pays', 'Pays', 'required|max_length[50]',
            array('required' => 'Vous devez entrer un email', 'max_length' => 'Le nom du pays ne doit pas dépasser 50 caractères'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view("modifyAddress");
        } else {

            // form is valid
            $numerorue = $this->input->post("numerorue");
            $adresse = $this->input->post("adresse");
            $ville = $this->input->post("ville");
            $codepostal = $this->input->post("codepostal");
            $pays = $this->input->post("pays");

            $user = $this->UserModel->findByEmail($this -> session -> user["email"]);
            if ($user == null) {
                $this->session->set_flashdata('error', 'Une erreur est survenue. Vous allez être déconnecté.');
                $this->logout();
            }
            
            $user->setNumRue($numerorue);
            $user->setAdresse($adresse);
            $user->setVille($ville);
            $user->setPostalCode($codepostal);
            $user->setPays($pays);


            $newuser = $this->UserModel->updateUser($user);

            if ($newuser == null){            
                $this->session->set_flashdata('error', 'Une erreur est survenue. Vous allez être déconnecté.');
                $this->logout();
            }

            
            $this->session->set_flashdata('success', 'Opération réalisée avec succès !');
            redirect('User/account');
        }
    }
    
    public function commandes(){
        if (!isset($this->session->user)) {
            redirect('Home');
            die();
        }
        $u = $this->UserModel->findByEmail($this->session->user["email"]);
        $p = $this->ProductModel->getProductsByUserId($u->getId());
        $this->load->view("commandes", array("p" => $p));
    }
}
?>