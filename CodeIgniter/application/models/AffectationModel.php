<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."AffectationEntity.php";
class AffectationModel extends CI_Model {
	
	
	/**
	 * La fonction findAll permet de trouver toutes les affectations
	 *  
	 */
    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get('affectation');
		$response = $q->custom_result_object("AffectationEntity");
		return $response;
    }


	/**
	 * La fonction findByIdProduct permet de trouver les affectations en lien avec un produit grace a son id
	 * 
	 * @param int | $id
	 * 
	 */
    public function findByIdProduct(int $id) {
		
		$this->db->select('*');
		$q = $this->db->get_where('affectation',array('id_produit'=>$id));
		$response = $q->custom_result_object("AffectationEntity");
		return $response;
	}

	/**
	 * La fonction findByIdCategorie permet de trouver les affectations en lien avec une catégorie grace à son id
	 * 
	 * @param int | $id
	 * 
	 */
    public function findByIdCategorie(int $id) {
		
		$this->db->select('*');
		$q = $this->db->get_where('affectation',array('id_categorie'=>$id));
		$response = $q->custom_result_object("AffectationEntity");
		return $response;
    }

	/**
	 * La fonction addAffectations permet d'ajouter de nouvelles affectations.
	 * 
	 * 
	 * 
	 * @param int | $productID
	 * @param array | $affectations
	 *
	 */
	public function addAffectations(int $productID, array $affectations){
		

		foreach($affectations as $affect) {
			try{
				$q = $this->db->query("CALL addAffectation(?,?)", array($productID, intval($affect)));
			} catch (Exception $e){
				//si on return ici, on ne pourrait pas ajouter les autres affectations.
			}

		}
    }

	/**
	 * La fonction removeAffectations permet de supprimer des affectations.
	 * 
	 * 
	 * @param int | $productID
	 * @param array | $affectations
	 * 
	 */
	public function removeAffectations(int $productID, array $affectations){
		

		foreach($affectations as $affect) {
			try{
				$q = $this->db->query("CALL removeAffectation(?,?)", array($productID, intval($affect)));
			} catch (Exception $e){
				//si on return ici, on ne pourrait pas supprimer les autres affectations.
			}
		}
    }
}
?>
