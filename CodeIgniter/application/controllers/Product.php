<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."Filtre.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltreAvailable.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltrePrice.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltreTri.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltrePage.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltreCategories.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FiltreName.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."Tri.php";
class Product extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("ProductModel");
        $this->load->model("CategorieModel");
        $this->load->model("UserModel");
        $this->load->model("AchatModel");
        $this->load->helper("url");
        //$this->output->enable_profiler(TRUE);
    }
    
    public function find(){
        $categories = $this->input->get('categorie');
        $name = $this->input->get('rechercher');
        $tri = $this->input->get('tri');
        $page = $this->input->get('page');
        $minprice = $this->input->get('price-min');
        $maxprice = $this->input->get('price-max');
        
        if ($minprice != null && !is_numeric($minprice)) {
            $minprice = 0;
        }
        if ($maxprice != null && !is_numeric($maxprice)) {
            $maxprice = 9999;
        }
        $filtre = new Filtre();
        if ($minprice != null && $maxprice != null) {
            $filtre = new FiltrePrice($filtre, $minprice, $maxprice);
        }
        if ($name != null && is_string($name)) {
            $filtre = new FiltreName($filtre, $name);
        }
        if ($tri != null && is_string($tri)) {
            $tri = Tri::getTriFromString($tri);
            $filtre = new FiltreTri($filtre, $tri);
        }
        if ($categories != null && is_array($categories)) {
            $filtre = new FiltreCategories($filtre, $categories);
        }

        $filtre = new FiltreAvailable($filtre, true);

        $produits = $this->ProductModel->findQueryBuilder($filtre);

        $endPage = intval((count($produits)-1) / 12)+1;
        if ($page != null){
            $page = intval($page);
            if ($page > $endPage) {
                $page = $endPage;
            }
            if ($page < 1) {
                $page = 1;
            } 
            $filtre = new FiltrePage($filtre, $page);
        } else {
            $page=1;
            $filtre = new FiltrePage($filtre, $page);
        }
        

        $produits = $this->ProductModel->findQueryBuilder($filtre);

        $categories = $this->CategorieModel->findAll();


        $this->load->view("products", array("produits"=>$produits, "categories"=>$categories, 'page'=>$page, 'endPage'=>$endPage));
    }

    public function display($productid){
        $id = intval($productid);
        $produit = $this->ProductModel->findByIdAvailable($id);
        if ($produit == null) {
            $this->session->set_flashdata('error', 'Le produit sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('product/find');
        }
        
        $isProductBought = false;
        if (isset($this->session->user)) {
            $email = $this->session->user['email'];
            $isProductBought = $this->AchatModel->boughtFromUser($productid, $email);
        }

        $path = $this->config->item('model_assets') . $productid;
        $c=0;
        if (is_dir($path)) {
            $files = scandir($path); //on liste les fichiers du dossier correspondant au produit
            array_splice($files, 0, 2); //on enlève . et .. qui sont respectivement le dossier actuel et le dossier précédent
            for($i=0;$i<count($files);$i++){ 
                $ext=pathinfo($files[$i], PATHINFO_EXTENSION); 
                if (!in_array($ext, $this->config->item("model_assets_ext"))){ //on vérifie que tous les fichiers du dossier sont supportés
                    unset($files[$i]); //comme on a models.zip dans ce dossier, c'est ici qu'on l'enlève.
                    $files = array_values($files);
                }
            }
            $c = count($files);
        }
        $inCart = isset($this->session->cart) && in_array($id, $this->session->cart);
        $this->load->view("product", array("produit"=>$produit, "incart"=>$inCart, "isbought"=>$isProductBought, "c"=>$c));

    }

}
