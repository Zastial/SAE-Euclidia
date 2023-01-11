<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Classe contact - utilisée pour la vue du contact et l'envoi de mail.
 */
class Contact extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Vue contact
     */
    public function index(){
        $this->load->view("contact");
    }

    /**
     * Fonction utilisée pour envoyer un mail.
     */
    public function sendMail() {
        $nom = $this->input->post("nom");
        $prenom = $this->input->post("prenom");
        $email = $this->input->post("email");
        $objet = $this->input->post("objet");
        $message = $this->input->post("message");

        $objet = $prenom . " " . $nom . " : " . $objet;
        $message = "Message de ".$email." :\n\n " . $message;
        try{
            mail('euclidia3d@proton.me', $objet, $message);
        } catch(Exception $e) {
            $this->session->set_flashdata('error', 'Il y a eu un problème lors de l\\\'envoi du message!');
            redirect("contact");
        }
        $this->session->set_flashdata('success', 'Votre email a bien été envoyé!');
        redirect("contact");
    }

}
?>