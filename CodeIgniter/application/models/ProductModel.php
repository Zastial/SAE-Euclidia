<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."ProductEntity.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."AffectationModel.php";
class ProductModel extends CI_Model {

	/**
	 * La fonction findAll permet de récupérer tout les produits contenus dans la base de données
	 */
    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get('produit');
		$response = $q-> custom_result_object("ProductEntity");
		return $response;
    }
	/**
	 * La fonction findAllAvailable permet de récupérer tout les produits étants disponibles contenus dans la base de données
	 */
	public function findAllAvailable() {
		$this->db->select('*');
			$q = $this->db->get_where('produit', array('disponible'=>true));
		$response = $q-> custom_result_object("ProductEntity");
		return $response;
	}

	/**
	 * La Fonction findById permet de récupérer un produit avec son id
	 * 
	 * @param int $id
	 * 
	 * @return ?ProductEntity
	 * 
	 */
    public function findById(int $id) : ?ProductEntity{
        $this->db->select('*');
		$params = array('id_produit'=>$id);
		$q = $q = $this->db->get_where('produit', $params);
		$response = $q->row(0,"ProductEntity");
		return $response;
    }

	/**
	 * La fonction findByIdAvailable permet de récupérer un produit disponible avec son id
	 * 
	 * @param int $id
	 * 
	 * @return ?ProductEntity
	 * 
	 */
	public function findByIdAvailable(int $id) : ?ProductEntity {
		$this->db->select('*');
		$params = array('id_produit'=>$id, 'disponible'=>true);
		$q = $this->db->get_where('produit', $params);
		$response = $q->row(0,"ProductEntity");
		return $response;
	}


	/**
	 * La fonction findQueryBuilder permet de trouver les Produits en fonction d'un filtre établi utilisé dans la page Products
	 * 
	 * @param FiltreInterface | $filtre
	 */
	
	public function findQueryBuilder(FiltreInterface $filtre) {
		// ?string $name, ?array $categories, ?string $tri, ?float $minprice, ?float $maxprice, ?bool $available
		$filtres = $filtre->getFiltres();
		try {
			$this->db->select('*');
			$this->db->from('produit');
			
			if (isset($filtres['name'])) {
				$this->db->group_start();
				$mots = explode(' ',$filtres['name']);
				foreach($mots as $mot){
					$this->db->or_like('produit.titre', $mot);
				}
				$this->db->group_end();
			}	

			if (isset($filtres['categories'])) {
				$this->db->join('affectation', 'affectation.id_produit = produit.id_produit');
				$this->db->where_in('affectation.id_categorie', $filtres['categories']);
			}

			if (isset($filtres['tri'])) {
				switch ($filtres['tri']) {
					case "1":
						$this->db->order_by('produit.prix', 'asc');
					case "2":
						$this->db->order_by('produit.prix', 'desc');
				}
			}

			$min = 0;
			$max = 9999;

			if (isset($filtres['minPrice'])) {
				$min = $filtres['minPrice'];
			}
			if (isset($filtres['maxPrice'])) {
				$max = $filtres['maxPrice'];
			}
			$available = true;
			if (isset($filtres['available'])) {
				$available = $filtres['available'];
			}
		
			$this->db->where('prix >=', $min);
			$this->db->where('prix <=', $max);
			$this->db->where('disponible =', $available);
			
			$query = $this->db->get();
			$response = $query->custom_result_object("ProductEntity");
			return $response;
		}catch (Exception $e) {
			return null;
		}
	}

	/**
	 * La fonction addProduct permet de rajouter un produit dans la base de donnée
	 * 
	 * @param ProductEntity | $product
	 * @param array | $categories
	 * 
	 * @return ?ProductEntity
	 */
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

		$this->load->model("AffectationModel"); 
		$this -> AffectationModel -> addAffectations($id,$categories);

		return $response;
    }

	/**
	 * La fonction updateProduct permet de changer les valeurs d'un produit
	 * 
	 * @param ProductEntity | $product
	 * @param array | $categories
	 * 
	 */
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

			$this->load->model("AffectationModel"); 
			$this->AffectationModel->addAffectations($product->getId(), $categories);

		} catch (Exception $e) {return null;} 
	}

	/**
	 * La fonction removeProduct permet de supprimer un produit
	 * 
	 * @param int | $productID
	 */
	public function removeProduct(int $productID) {
		try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->delete('achat', array('id_produit' => $productID));

			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->delete('affectation', array('id_produit' => $productID));

			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->delete('favori', array('id_produit' => $productID));

			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->delete('produit', array('id_produit' => $productID));

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
