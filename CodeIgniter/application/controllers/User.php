<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("UserModel");
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
            
            if ($this->session->cart) {
                redirect('shoppingCart');
            }
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
            $newPassword = $this->input->post("new-password");

            $user = $this->UserModel->findByEmail($email);
            if ($user == null) {
                $this->session->set_flashdata('error', 'Une erreur est survenue. Vous allez être déconnecté.');
                $this->logout();
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
        $this->load->view("account");
    }
}
?>