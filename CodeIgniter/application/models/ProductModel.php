<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."ProductEntity.php";
class ProductModel extends CI_Model {
    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get('produit');
		$response = $q-> custom_result_object("ProductEntity");
		return $response;
    }

    public function findById($id) : ?ProductEntity{
        $this->db->select('*');
		$q = $this->db->get_where('produit',array('id_produit'=>$id));
		$response = $q->row(0,"UserEntity");
		return $response;
    }

    public function addProduct(ProductEntity $product):?ProductEntity{
        $data = array($product->getId(), $product->getTitre(), $product->getPrix(), $product->getDescription(), $product->getDisponible());
        try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->insert('produit', $data);
			$this->db->db_debug = $db_debug;
		} catch (Exception $e) {}

		return $this->findById($id);
    }

}
?>
