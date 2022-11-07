<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("ProductModel")
    }
    
    public function index(){

    }

    public function show($id){
        
    }

}
