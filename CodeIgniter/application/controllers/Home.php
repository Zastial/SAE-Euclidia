<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/** Cette classe sert a afficher la vue de la page principale.
 */
class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->load->view("home");
    }
}
?>