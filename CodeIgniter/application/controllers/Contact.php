<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->load->view("contact");
    }

    public function sendMail() {
        $nom = $this->input->post("nom");
        $prenom = $this->input->post("prenom");
        $email = $this->input->post("email");
        $objet = $this->input->post("objet");
        $message = $this->input->post("message");

        $objet = $prenom . " " . $nom . " : " . $objet;

        mail('michenaudmathis@gmail.com', $objet, $message);
    
        redirect("contact");
    }

}
?>