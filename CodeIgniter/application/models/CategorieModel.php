<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."CategorieEntity.php";
class CategorieModel extends CI_Model {
    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get('categorie');
		$response = $q->custom_result_object("CategorieEntity");
		return $response;
    }

	/**
	 * La fonction findById trouve la Catégorie en fonction de son id
	 * 
	 * @param int | $id
	 * 
	 * @return ?CategorieEntity
	 * 
	 */
    public function findById(int $id) : ?CategorieEntity{
        $this->db->select('*');
		$params = array('id_categorie'=>$id);
		$q = $q = $this->db->get_where('categorie', $params);
		$response = $q->row(0,"CategorieEntity");
		return $response;
    }

	public function findQueryBuilder(FiltreInterface $filtre) {
		$filtres = $filtre->getFiltres();
		try {
			$this->db->select('*');
			$this->db->from('categorie');

			if (isset($filtres['name'])) {
				$this->db->group_start();
				$mots = explode(' ',$filtres['name']);
				foreach($mots as $mot){
					$this->db->or_like('categorie.libelle', $mot);
				}
				$this->db->group_end();
			}

			if (isset($filtres['tri'])) {
				switch($filtres['tri']) {
					case Tri::NOMCROISSANT:
						$this->db->order_by('categorie.libelle', 'asc');
						break;
					case Tri::NOMDECROISSANT:
						$this->db->order_by('categorie.libelle', 'desc');
						break;
				}
			}

			$query = $this->db->get();
			$response = $query->custom_result_object("CategorieEntity");
			return $response;

		} catch (Exception $e) {
			return null;
		}

	}

	/**
	 * La Fonction addCategorie ajoute une categorie dans la base de donnée
	 * 
	 * @param CategorieEntity | $categorie
	 * 
	 * @return ?CategorieEntity
	 * 
	 */
	public function addCategorie(CategorieEntity $categorie):?CategorieEntity{
		try{
			$q = $this->db->query("CALL addCategorie(?)", array($categorie->getLibelle()));
		} catch (Exception $e){
			return null;
		}
		// get last inserted row
		$id = $this->db->insert_id();
		$q = $this->db->get_where('categorie', array('id_categorie' => $id));
		$response = $q->row(0,"CategorieEntity");

		return $response;
    }

	/**
	 * La fonction updateCategorie permet de changer le nom de la catégorie à partir de son Id
	 * 
	 * @param CategorieEntity | $categorie
	 * 
	 */
	public function updateCategorie(CategorieEntity $categorie){
		try{
			$q = $this->db->query("CALL updateCategorie(?,?)", array($categorie->getId(), $categorie->getLibelle()));
		} catch (Exception $e){
			return null;
		}
	}

	/**
	 * La fonction removeCategorie permet de supprimer une catégorie en fonction de son ID
	 * 
	 * @param int | $categorieID
	 */
	public function removeCategorie(int $categorieID) {
		try{
			$q = $this->db->query("CALL removeCategorie(?)", array($categorieID));
		} catch (Exception $e){
			return null;
		}
	}

	public function findByModelId(int $id) {
		$this->db->select('categorie.*');
		$this->db->from('categorie');
		$this->db->join('affectation', 'categorie.id_categorie = affectation.id_categorie');
		$this->db->where('affectation.id_produit =', $id);
		$q = $this->db->get();
		$response = $q->custom_result_object("CategorieEntity");
		return $response;
	}


}
?>
