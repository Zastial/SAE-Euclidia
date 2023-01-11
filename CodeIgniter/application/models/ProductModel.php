<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."ProductEntity.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."CategorieModel.php";
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
		$filtres = $filtre->getFiltres();
		try {
			$this->db->select('*');
			$this->db->from('produit');
			
			if (isset($filtres['name'])) {
				$this->db->group_start();
				$mots = explode(' ',$filtres['name']);
				foreach($mots as $mot){
					$this->db->or_like('produit.titre', $mot);
					// si on veut chercher par id :  
					// $this->db->or_like('produit.id_produit', $mot);
				}
				$this->db->group_end();
			}	

			if (isset($filtres['categories'])) {
				$this->db->join('affectation', 'affectation.id_produit = produit.id_produit');
				$this->db->where_in('affectation.id_categorie', $filtres['categories']);
			}

			if (isset($filtres['tri'])) {
				switch ($filtres['tri']) {
					case Tri::PRIXCROISSANT:
						$this->db->order_by('produit.prix', 'asc');
						break;
					case Tri::PRIXDECROISSANT:
						$this->db->order_by('produit.prix', 'desc');
						break;
				}
			}

			if (isset($filtres['tri-nom'])) {
				switch($filtres['tri-nom']) {
					case Tri::NOMCROISSANT:
						$this->db->order_by('produit.titre', 'asc');
						break;
					case Tri::NOMDECROISSANT:
						$this->db->order_by('produit.titre', 'desc');
						break;
				}
			}

			$min = 0;
			$max = 9999.99;

			if (isset($filtres['minPrice'])) {
				$min = $filtres['minPrice'];
			}
			if (isset($filtres['maxPrice'])) {
				$max = $filtres['maxPrice'];
			}

			if (isset($filtres['available'])) {
				$this->db->where('disponible =', $filtres['available']);
			}
		
			$this->db->where('prix >=', $min);
			$this->db->where('prix <=', $max);
			if (isset($filtres['page'])){
				$page=$filtres['page'];
				if ($page<=0)$page=1;
				$this->db->limit(12, ($page-1)*12);
			}
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
		try{
			$this->db->trans_start();
			$q = $this->db->query("CALL addProduct(?,?,?,?,@result)", array($product->getTitre(), $product->getPrix(), $product->getDescription(), $product->getDisponible()));
			$qu = $this->db->query("SELECT @result as res");
			$this->db->trans_complete();
			$id=intval($qu->row_array(0)["res"]);
		} catch (Exception $e){
			return null;
		}
		
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
		try{
			$q = $this->db->query("CALL updateProduct(?,?,?,?,?)", array($product->getId(), $product->getTitre(), $product->getPrix(), $product->getDescription(), $product->getDisponible()));
			$this->db->delete('affectation', array('id_produit' => $product->getID())); 

			$this->load->model("CategorieModel");
			$this->load->model("AffectationModel"); 

			$selectedCategories = $this->CategorieModel->findByModelId($product->getId());
			$this->AffectationModel->removeAffectations($product->getId(), array_diff($categories, $selectedCategories));

			$this->AffectationModel->addAffectations($product->getId(), $categories);
			return true;
		} catch (Exception $e){
			return false;
		}
		
	}

	/**
	 * Deletes a product based on its id (removes every record of it in achat, affectation and produit)
	 * 
	 * @param int | $productID
	 * @return bool 
	 */
	public function removeProduct(int $productID) {
		try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->delete('achat', array('id_produit' => $productID));
			$this->db->delete('affectation', array('id_produit' => $productID));
			$this->db->delete('produit', array('id_produit' => $productID));
			$this->db->db_debug = $db_debug;
			return true;

		} catch (Exception $e) {return false;} 
	}

	/**
	 * findByFacture trouve les produits qui sont dans une facture.
	 * @param int $id
	 * @return ProductEntity
	 */
	public function findByFacture($id) {
		$this->db->select('facture.*');
		$this->db->from('produit');
		$this->db->join('achat', 'facture.id_produit = achat.id_produit');
		$this->db->where(array("achat.id_facture"=>$id));
		$q = $this->db->get();
		$response = $q->custom_result_object("ProductEntity");
		return $response;
	}

	/**
	 * getProductByUserId permet de trouver une liste de produits qu'un utilisateur a acheté.
	 * @param int $id
	 * @return ProductEntity[]
	 */
	public function getProductsByUserId($id){
		$q = $this->db->query("CALL getBoughtProductsOfUser(".$id.")");
		$response = $q->custom_result_object("ProductEntity");
		return $response;
	}

	/**
	 * getNumberOfAvailableProducts retourne le nombre de produits disponibles dans la base de onnées
	 * 
	 * @return int
	 */
	public function getNumberOfAvailableProducts() {
		return $this->db->where(['disponible'=>1])->from("produit")->count_all_results();
	}
}
?>
