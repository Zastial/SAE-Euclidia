<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."ProductEntity.php";
class ProductModel extends CI_Model {

    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get('produit');
		$response = $q-> custom_result_object("ProductEntity");
		return $response;
    }

	public function findAllAvailable() {
		$this->db->select('*');
			$q = $this->db->get_where('produit', array('disponible'=>true));
		$response = $q-> custom_result_object("ProductEntity");
		return $response;
	}

	/**
	 * @param int $id
	 */
    public function findById(int $id) : ?ProductEntity{
        $this->db->select('*');
		$params = array('id_produit'=>$id);
		$q = $q = $this->db->get_where('produit', $params);
		$response = $q->row(0,"ProductEntity");
		return $response;
    }

	public function findByIdAvailable(int $id) : ?ProductEntity {
		$this->db->select('*');
		$params = array('id_produit'=>$id, 'disponible'=>true);
		$q = $q = $this->db->get_where('produit', $params);
		$response = $q->row(0,"ProductEntity");
		return $response;
	}

	/**
	 * @param array $ids
	 */
	public function findByCategories(array $ids) {
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

	public function findByCategoriesAvailable(array $ids) {
		$sql = "select * from produit as p1 where p1.disponible = true AND NOT EXISTS (
			SELECT * from categorie WHERE id_categorie IN ?
		  AND id_categorie NOT IN (
				select a.id_categorie FROM affectation as a JOIN produit p2 ON p2.id_produit = a.id_produit WHERE p2.id_produit = p1.id_produit
			)
		);";
		$q = $this->db->query($sql, array($ids));
		$response = $q-> custom_result_object("ProductEntity");
		return $response;
	}

    public function addProduct(ProductEntity $product, array $categories):?ProductEntity{
        $data = array(
			'titre'=>$product->getTitre(), 
			'prix'=>$product->getPrix(), 
			'description'=>$product->getDescription(), 
			'disponible'=>$product->getDisponible());
			
        try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->insert('produit', $data);
			$this->db->db_debug = $db_debug;
			
		} catch (Exception $e) {return null;}

		// get last inserted row
		$id = $this->db->insert_id();
		$q = $this->db->get_where('produit', array('id_produit' => $id));
		$response = $q->row(0,"ProductEntity");

		$this -> AffectationModel -> addAffectations($id,$categories);

		return $response;
    }

	public function updateProduct(ProductEntity $product, array $categories){
		try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->set('titre', $product->getTitre());	
			$this->db->set('prix', $product->getPrix());		
			$this->db->set('description', $product->getDescription());			
			$this->db->set('disponible', $product->getDisponible());
			$this->db->where('id_produit', $product->getId());
			$result = $this->db->update('produit');
			$this->db->db_debug = $db_debug;

			if (!$result) {
				return null;
			}

			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->delete('affectation', array('id_produit' => $product->getID())); 

			$this->AffectationModel->addAffectations($product->getId(), $categories);

		} catch (Exception $e) {return null;} 
	}

	public function removeProduct(int $productID) {
		try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->delete('produit', array('id_produit' => $productID));

			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->delete('achat', array('id_produit' => $productID));

			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->delete('favori', array('id_produit' => $productID));

		} catch (Exception $e) {return null;} 
	}

	public function findByFacture($id) {
		$this->db->select('facture.*');
		$this->db->from('produit');
		$this->db->join('achat', 'facture.id_produit = achat.id_produit');
		$this->db->where(array("achat.id_facture"=>$id));
		$q = $this->db->get();
		$response = $q->custom_result_object("ProductEntity");
		return $response;
	}

	public function getProductsByUserId($id){
		$q = $this->db->query("CALL getBoughtProductsOfUser(".$id.")");
		$response = $q->custom_result_object("ProductEntity");
		return $response;
	}
}
?>
