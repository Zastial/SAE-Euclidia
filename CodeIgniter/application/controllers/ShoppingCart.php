<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."Payment.php";
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

        // name of payment
        $name = $this->input->post("choose");
        // object handling payment
        $payment = Payment::getPaymentMethod($name);
        
        if ($payment == null) {
            $this->session->set_flashdata('error', 'La méthode de paiement est indéfnie. Veuillez réessayer.');
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
     * Verify the cart
     * remove unavailable or already bought items from the cart
     * if the cart is modified, redirect the user to the shopping cart page
     */
    private function verifyCart() {
        $this->load->model("AchatModel");
        $updatedCart = array();
        $mail = (isset($this->session->user)) ? $this->session->user["email"] : "";
        foreach ($this->session->cart as $index=>$id) {
            $prod = $this->ProductModel->findByIdAvailable($id);

            // if the user is connected and bought the model, do not add it in the updated cart
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

    // returns true if cart contains product of id = $id
    private function cartContains(int $id): bool {
        return in_array($id, $this->session->cart);
    }

    public function emptyCart(){
        if (!empty($this->session->cart)){
            $this->session->set_flashdata('info', 'Le panier vient d\\\'être vidé.');
        }
        $this->session->set_userdata("cart",array());
        redirect('shoppingCart');
    }

    public function get_card_total(): int {
        $items_in_cart = count($_SESSION["cart"]);
        return $items_in_cart;
    }
    
}
?>