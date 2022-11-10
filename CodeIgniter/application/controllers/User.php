<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    
    public function register() {
        // TODO : vérifier qu'un utilisateur n'est pas déjà connecté
        $this->load->view("inscription");
    }

    public function login() {
        // TODO : vérifier qu'un utilisateur n'est pas déjà connecté
        $this->load->view("connexion");
    }

    public function logout() {
        // TODO : déconnecter l'utilisateur (unset + destroy)
    }

    public function registerCheck() {

    }

    public function loginCheck() {
        
    }

}
?>