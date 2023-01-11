<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."Payment.php";
/**
 * Classe utilisée pour le panier d'un utilisateur.
 * Le panier marche aussi lorsqu'on est pas connecté, et sera conservé a la prochaine connexion.
 */
class ShoppingCart extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("ProductModel");
        $this->load->model("UserModel");
        $this->load->model("FactureModel");
        $this->load->model("AchatModel");
        $this->load->library('user_agent');

        if (isset($this->session->user) && $this->session->user['status'] != "Utilisateur") {
            redirect("Home");
        }
        
        if (!isset($this->session->cart)) {
            $this->session->set_userdata("cart",array());
        }
        $this->verifyCart();
    }

    /**
     * page principale.
     */
    public function index(){

        $produits = array();
        foreach ($this->session->cart as $index=>$id) {
            $prod = $this->ProductModel->findByIdAvailable($id);
            if ($prod != null) {
                $produits[] = $prod;
            }
            
        }
        $this->load->view("shoppingCart", array('produits'=>$produits));
    }

    /**
     * Fonction appelée lors de l'ajout d'un produit au panier.
     * Le produit sera ajouté au panier si il n'y est pas déjà et si l'utilisateur ne possède pas le produit.
     * @param int $productid -> l'id du produit a jouter au panier.
     */
    public function addProduct($productid=null){
        $id = intval($productid);
        $produit = $this->ProductModel->findByIdAvailable($id);
        
        if ($produit == null) {
            $this->session->set_flashdata('error', 'Le produit sélectionné n\\\'existe pas ou n\\\'est plus disponible.');
            redirect('shoppingCart');
        }

        if ($this->cartContains($id)) {
            $this->session->set_flashdata('warning', 'Ce produit est déjà dans votre panier !');
            redirect('product/display/'.$id);
        }

        $cart = $this->session->cart;
        $cart[] = $id;
        $this->session->set_userdata("cart",$cart);
    
        $this->session->set_flashdata('info', 'Produit ajouté au panier.');
        redirect("product/display/".$id);
        
    }
    /**
     * Supprime un produit si il n'est pas dans le panier.
     * @param int $productid -> l'id du produit a supprimer du panier.
     */
    public function removeProduct($productid=null){
        $id = intval($productid);
        $cart = $this->session->cart;

        if (($key = array_search($id, $cart)) !== false) {
            unset($cart[$key]);
        } else {
            $this->session->set_flashdata('warning', 'Le produit que vous souhaitez retirer n\\\'est pas dans votre panier.');
            redirect('shoppingCart');
        }

        $this->session->set_flashdata('info', 'Produit retiré du panier.');
        $this->session->set_userdata("cart",$cart);
        redirect($this->agent->referrer());
    }

    /**
     * Fonction utilisée pour passer commande et afficher la vue qui résume les produits a acheter.
     */
    public function orderCommand() {
        $produits = array();

        if (!isset($this->session->user) || !isset($this->session->cart) || empty($this->session->cart) ) {
            redirect('shoppingCart');
        }

        foreach ($this->session->cart as $id) {
            $produits[] = $this->ProductModel->findByIdAvailable($id);
        }

        $this->load->view("orderCommand", array('produits'=>$produits));
    }

    /**
     * fontion utilisée pour valider le paiement.
     */
    public function validatePayment() {

        if (!isset($this->session->user) || !isset($this->session->cart) || empty($this->session->cart) ) {
            redirect('shoppingCart');
        }

        $user = $this->UserModel->findByEmail($this->session->user['email']);

        if($user->getAdresse() == "NON DEFINI") {
            $user->setNumRue($this->input->post("rue"));
            $user->setAdresse($this->input->post("adresse"));
            $user->setVille($this->input->post("ville"));
            $user->setPostalCode($this->input->post("code_postal"));
            $user->setPays($this->input->post("pays"));
            $this->UserModel->updateUser($user);
        }

        // nom du moyen de paiement
        $name = $this->input->post("choose");
        // l'objet qui va gérer le paiement
        $payment = Payment::getPaymentMethod($name);
        
        if ($payment == null) {
            $this->session->set_flashdata('error', 'La méthode de paiement est indéfinie. Veuillez réessayer.');
            redirect('shoppingCart/orderCommand');
        }

        if (!$payment->verifyPayment()) {
            $this->session->set_flashdata('error', 'Le paiement a été refusé.');
            redirect('shoppingCart/orderCommand');
        }

        $f = new FactureEntity();
        $f->setDate(date('Y-m-d H:i:s'));
        $f->setTotal($this->input->post("total"));
        $f->setUserId($this->UserModel->findByEmail($this->session->user["email"])->getId());
        $f->setAdresse($this->input->post("adresse"));
        $f->setNumeroRue($this->input->post("rue"));
        $f->setPays($this->input->post("pays"));
        $f->setVille($this->input->post("ville"));
        $f->setCodePostal($this->input->post("code_postal"));
        $f->setPaiement($this->input->post("choose"));

        $f = $this->FactureModel->addFacture($f);
        if (is_null($f)){ 
            $this->session->set_flashdata('error', 'L\\\'enregistrement de votre facture a échoué!');
            redirect('shoppingCart');
        }

        $this->session->set_flashdata('success', 'Paiement réussi !');

        $panier = $this->session->cart;
        $this->session->set_userdata("cart",array());
        $this->addAchat($f, $panier);
        redirect('User/account');
    }

    /**
     * fonction utilisée pour définir que l'utilisateur a acheté un produit.
     * @param FactureEntity $f Facture auquel l'achat va correspondre
     * @param array $panier -> liste d'id de produits qui vont être achetés.
     */
    private function addAchat(FactureEntity $f, array $panier) {
        foreach ($panier as $id) {
            $a = new AchatEntity();
            $prod = $this->ProductModel->findByIdAvailable($id);

            if (is_null($prod)){
                $this->session->set_flashdata('error', 'L\\\'enregistrement de votre achat a échoué!');
                redirect('shoppingCart');
            }

            $a->setIdFacture($f->getId());
            $a->setIdProduit($id);
            $a->setPrix($prod->getPrix());
            $this->AchatModel->addAchat($a);
        }
    }
    
    /**
     * Vérifier le panier
     * suppression des produits non disponibles ou déjà achetés.
     * Si il y a un changement, on redirige l'utilisateur vers la page du panier.
     */
    private function verifyCart() {
        $this->load->model("AchatModel");
        $updatedCart = array();
        $mail = (isset($this->session->user)) ? $this->session->user["email"] : "";
        foreach ($this->session->cart as $index=>$id) {
            $prod = $this->ProductModel->findByIdAvailable($id);

            // si l'utilisateur est connecté et a acheté le produit, on ne l'ajoute pas au panier.
            if ($mail != "" && $this->AchatModel->boughtFromUser($id, $mail)) {
                continue;
            }
            if ($prod != null) {
                $updatedCart[] = $id;
            }
        }
        
        if (count($updatedCart) != count($this->session->cart)) {
            $this->session->set_userdata("cart",$updatedCart);
            $this->session->set_flashdata('error', 'Un produit de votre panier n\\\'est plus disponible !');
            redirect('shoppingCart');
        }
    }

    /** 
     * cartContains retourne true si le panier contient un produit de l'id $id.
     * @param int $id
     * @return bool
    */
    private function cartContains(int $id): bool {
        return in_array($id, $this->session->cart);
    }
    /**
     * vider le panier
     */
    public function emptyCart(){
        if (!empty($this->session->cart)){
            $this->session->set_flashdata('info', 'Le panier vient d\\\'être vidé.');
        }
        $this->session->set_userdata("cart",array());
        redirect('shoppingCart');
    }

    /**
     * @return int 
     * retourne le nombre de produits dans le panier
     */
    public function get_card_total(): int {
        $items_in_cart = count($_SESSION["cart"]);
        return $items_in_cart;
    }
    
}
?>