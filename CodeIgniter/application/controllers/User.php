<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("UserModel");
    }
    
    private function error($err, $page){
        $this->session->set_flashdata('previous', base_url($page));
        $this->session->set_flashdata('error', $err);
        $this->load->view("error");
    }

    public function register() {
        // redirect to home if user is already connected
        if (isset($this->session->user)) {
            redirect('Home');
            die();
        }
        $this->load->view("inscription");
    }

    public function login() {
        // redirect to home if user is already connected
       if (isset($this->session->user)) {
            redirect('Home');
            die();
       }
        $this->load->view("connexion");
    }

    public function logout() {
        $this->session->unset_userdata("user");
        $this->session->unset_userdata("cart");
		$this->session->sess_destroy();
        redirect('Home');
    }

    public function registerCheck() {
        $nom = $this->input->post("nom");
        $prenom = $this->input->post("prenom");
        $email = $this->input->post("email");
        $password = $this->input->post("password");


        if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
            $this->session->set_flashdata('error', 'Un ou plusieurs champs sont vides!');
            redirect('User/register');
        }

        if ($this->checkName($nom) & $this->checkName($prenom)){

            $uppercase=preg_match('@[A-Z]@',$password);
            $lowercase=preg_match('@[a-z]@',$password);
            $number=preg_match('@[0-9]@',$password);
            $specialChars=preg_match('@[^\w]@',$password);

            if(!$uppercase||!$lowercase||!$number||!$specialChars||strlen($password)<5){
                $this->session->set_flashdata('error', 'PASSWORD ERROR: must have 1 uppercase, lowercase, number and specialChars');
                redirect('User/register');
            }else{

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
                    $this->session->set_flashdata('error', 'DATABASE REGISTER ERROR');
                    redirect('User/register');
                } else {
                    $this->session->set_flashdata('success', 'Inscription réussie! Vous pouvez maintenant vous connecter');
                    redirect('User/login');
                }
            }
    
        }
        $this->session->set_flashdata('error', 'Erreur : Caractères Spéciaux dans le nom');
        redirect('User/register');

    }


    public function checkName(string $name){
        $pieces = explode(" ", $name);

        foreach ($pieces as $p){
            $mot = "";
            if ($p!=" "){
                if ($mot==""){
                    $mot=$p;
                }
            }
            $UneChaine = preg_replace('/[^A-Za-z\-]/', '', $mot); 
            if (strlen($mot)!= strlen($UneChaine)){
                return false;
            }
        
        }
        return true;

    }


    public function loginCheck() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if (empty($email) || empty($password)) {
            $this->session->set_flashdata('error', 'Un ou plusieurs champs sont vides!');
            redirect('User/login');
        }

        $user = $this->UserModel->findByEmail($email);
        
        if ($user == null || !$user->isValidPassword($password)) {
            $this->session->set_flashdata('error', 'Erreur : Identifiant ou mot de passe incorrect.');
            redirect('User/login');
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
        if (!isset($this->session->user)) {
            redirect('Home');
        }
        $this->load->view("account");
        
    }

    public function changePass(){
        // redirect to home if user is not logged in
        if (!isset($this->session->user)) {
            redirect('Home');
        }
        $this->load->view("changePass");
    }

    public function changeName(){
        // redirect to home if user is not logged in
        if (!isset($this->session->user)) {
            redirect('Home');
       }
        $this->load->view("changeName");
    }

    public function checkPassChange(){
        $oldpass = $this->input->post('oldpass');
        $newpass = $this->input->post('newpass');
        
        // if user is not logged in 
        if (!isset($this->session->user)){
            $this->session->set_flashdata('error', 'Vous avez été déconnecté. Veuillez vous reconnecter.');
            redirect('User/login');
        }
        $email = $this->session->user["email"];
        if (empty($oldpass) || empty($newpass) || empty($email)){ //note : empty email should NEVER happen - it means the session is alive but broken
            $this->session->set_flashdata('error', 'Un champ n\'a pas été rempli!');
            redirect('User/changePass');
        }
        $user = $this->UserModel->findByEmail($email);
        if ($user == null || !$user->isValidPassword($oldpass)) {   
            $this->session->set_flashdata('error', 'Mot de passe non valide!');
            redirect('User/changePass');
        }
        $user->setEncryptedPassword($newpass);
        $newuser = $this->UserModel->updateUser($user);
        if ($newuser == null){
            $this->session->set_flashdata('error', 'DATABASE ERROR 1'); //todo better error
            redirect('User/changePass');
        }

        $this->session->unset_userdata("user");
		$this->session->unset_userdata("cart");
        $this->session->set_flashdata('success', 'Opération réalisée avec succès! Veuillez vous reconnecter.');
        redirect('User/login');
    }

    public function checkNameChange(){
        $nom = $this->input->post('nom');
        $prenom = $this->input->post('prenom');
        $newemail = $this->input->post('email');
        $curemail = $this->session->user["email"];
        if (!isset($this->session->user)){
            $this->session->set_flashdata('error', 'Vous avez été déconnecté. Veuillez vous reconnecter.');
            redirect('User/login');
        }
        if (empty($nom) || empty($prenom) || empty($newemail) || empty($curemail)){ 
            $this->session->set_flashdata('error', 'Un ou plusieurs champs sont vides!');
            redirect('User/changeName');
        }
        $user = $this->UserModel->findByEmail($curemail);
        if ($user == null) {
            $this->session->set_flashdata('error', 'DATABASE ERROR 2'); //todo better error
            redirect('User/changeName');
        }
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setEmail($newemail);
        $newuser = $this->UserModel->updateUser($user);

        if (is_null($newuser)){            
            $this->session->set_flashdata('error', 'Votre adresse e-mail est déjà utilisée sur un autre compte!'); //todo better error
            redirect('User/changeName');
        }

        if ($newemail != $newuser->getEmail()) {
            $this->session->unset_userdata("user");
            $this->session->unset_userdata("cart");
            $this->session->set_flashdata('success', 'Opération réalisée avec succès! Veuillez vous reconnecter.');
            redirect('User/login');
        } 

        // update user in session
        $this->session->set_userdata("user",array(
            "nom"=>$newuser->getNom(),
            "prenom"=>$newuser->getPrenom(),
            "email"=>$newuser->getEmail(), 
            "status"=>$newuser->getStatus()));

        redirect('User/account');
    }
}
?>