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
		$response = $q->row(0,"ProductEntity");
		return $response;
    }

	public function findByCategories(array $ids) {
		/*
		$this->db->select('*');
		$this->db->from('produit');
		$this->db->join('affectation', 'produit.id_produit = affectation.id_produit');
		$this->db->where_in('affectation.id_categorie', $ids);
		if (count($ids) > 1) {
			$this->db->group_by('affectation.id_categorie');
			$this->db->having('count(affectation.id_categorie)', count($ids));
		}
		$q = $this->db->get();
		$response = $q-> custom_result_object("ProductEntity");
		return $response;
		*/
		$sql = "select * from produit as p1 where NOT EXISTS (
			SELECT * from categorie WHERE id_categorie IN ?
		  AND id_categorie NOT IN (
				select a.id_categorie FROM affectation as a JOIN produit p2 ON p2.id_produit = a.id_produit WHERE p2.id_produit = p1.id_produit
			)
		);";

		$q = $this->db->query($sql, array($ids));
		$response = $q-> custom_result_object("ProductEntity");
		return $response;

	}

    public function addProduct(ProductEntity $product):?ProductEntity{
        $data = array(
			'id_produit'=>$product->getId(), 
			'titre'=>$product->getTitre(), 
			'prix'=>$product->getPrix(), 
			'description'=>$product->getDescription(), 
			'disponible'=>$product->getDisponible());
			
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
