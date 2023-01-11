<?php
/**
 * Cette classe est utilisée pour charger les images et les modèles.
 */
class Resource extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("ProductModel");
        $this->load->model("AchatModel");
    }

    /**
     * Fonction utilisée pour charger les images.
     * @param int $file -> le numéro du produit correspondant a l'image qu'on veut récupérer
     * @param int $number -> le numéro de l'image - défaut 0.
     */
    public function picture($file, $number=0) {
        $path = $this->config->item('model_assets') . $file;
        if (!is_dir($path)) {
            $this->default();
        }

        $file_ext = "";
        foreach ($this->config->item('model_assets_ext') as $ext) {
            if(file_exists($path."/".$number.".".$ext)) {
                $file_ext = $ext;
                break;
            }
        }
        
        if (empty($file_ext)) {
            $this->default();
        } else {
            header('Content-type: image/'.$ext);
            readfile($path . "/".$number.".".$file_ext);
        }
    }

    /**
     * Charge l'image par défaut. est utilisé dans picture par exemple.
     */
    public function default() {
        header('Content-type: image/png');
        readfile($this->config->item('model_assets') . "default/default-img.png");
    }

    /**
     * Fonction utilisée pour obtenir un modèle 3D aléatoire a afficher sur la page d'accueil
     */
    public function getRandomHomeModel() {
        $path = $this->config->item('model_assets') . "home/";
        if (!is_dir($path)) {
            die();
        }

        $files = scandir($path);
        $models = array();
        foreach ($files as $f) {
            $ext = pathinfo($f, PATHINFO_EXTENSION);
            if ($ext == "glb" || $ext == "gltf") {
                $models[] = $path . $f;
            }
        }
        
        if (empty($models)) {
            die();
        }

        $key = array_rand($models);
        header('Content-type: text/json');
        readfile($models[$key]);
    }

    /**
     * fonction qui sert a obtenir un zip des modèles 3d correspondant a un produit.
     * @param int $productid -> l'id du produit correspondat aux modèles.
     */
    public function model($productid){
        $id = intval($productid);
        $produit = $this->ProductModel->findById($id);
        if ($produit == null){
            $this->session->set_flashdata('error', 'Le produit sélectionné n\\\'existe plus! Nous nous excusons de la gêne occasionnée.');
            redirect($_SERVER['HTTP_REFERER']); //On redirige vers la page précédente
        }
        if (!$this->AchatModel->boughtFromUser($productid, $this->session->user["email"])){
            $this->session->set_flashdata('error', 'Vous n\\\'avez pas acheté ce produit!');
            redirect($_SERVER['HTTP_REFERER']); //On redirige vers la page précédente
        }
        $path = $this->config->item('model_assets') . $id . '/models.zip';
        header('Content-Description: File Transfer');
        header('Content-type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$produit->getTitre().'.zip'.'"');
        readfile($path);
    }
}
?>