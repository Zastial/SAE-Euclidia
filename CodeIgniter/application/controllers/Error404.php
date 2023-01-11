<?php 
/**
 * Cette classe, comme son nom l'indique, ne sert qu'a afficher l'erreur 404.
 */
class Error404 extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
    } 

    public function index() { 
        $this->output->set_status_header('404'); 
        $this->load->view('error404');
    } 

} 