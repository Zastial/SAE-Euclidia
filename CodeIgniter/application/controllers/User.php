<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("UserModel");
    }
    
    public function register() {
        if (isset($this->session->user)) {
            redirect('Home');
            die();
       }
        $this->load->view("inscription");
    }

    public function login() {
       if (isset($this->session->user)) {
            redirect('Home');
            die();
       }
        $this->load->view("connexion");
    }

    public function logout() {
        $this->session->unset_userdata("user");
		$this->session->sess_destroy();
        redirect('Home');
    }

    public function registerCheck() {
        $nom = $this->input->post("nom");
        $prenom = $this->input->post("prenom");
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
            $this->load->view('inscription', array('error' => true));
            die();
        }

        $status = "Utilisateur";
        $id = $this->UserModel->getNewId();

        $user = new UserEntity();

        $user->setId($id);
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setEmail($email);
        $user->setEncryptedPassword($password);
        $user->setStatus($status);

        // add user to database, returns null if it didn't work
        $user = $this->UserModel->addUser($user);
        
        if ($user == null) {
            $this->load->view('inscription', array('error' => true));
        } else {
            redirect('User/login');
        }

    }

    public function loginCheck() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if (empty($email) || empty($password)) {
            $this->load->view('connexion', array('error' => true));
            die();
        }

        $user = $this->UserModel->findByEmail($email);
        
        if ($user == null || !$user->isValidPassword($password)) {
            $this->load->view('connexion', array('error' => true));
        } else {
            
            $this->session->set_userdata("user",array(
                "nom"=>$user->getNom(),
                "prenom"=>$user->getPrenom(),
                "email"=>$user->getEmail(), 
                "status"=>$user->getStatus()));
            redirect('Home');
        }
    }

    public function account() {
        $this->load->view("account");
    }

}
?>