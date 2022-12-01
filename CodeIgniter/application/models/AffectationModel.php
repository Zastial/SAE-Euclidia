<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."AffectationEntity.php";
class AffectationModel extends CI_Model {

    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get('affectation');
		$response = $q->custom_result_object("AffectationEntity");
		return $response;
    }

    public function findByIdProduct(int $id) {
		$this->db->select('*');
		$q = $this->db->get_where('affectation',array('id_produit'=>$id));
		$response = $q->custom_result_object("AffectationEntity");
		return $response;
	}

    public function findByIdCategorie(int $id) {
		$this->db->select('*');
		$q = $this->db->get_where('affectation',array('id_categorie'=>$id));
		$response = $q->custom_result_object("AffectationEntity");
		return $response;
    }


	public function addAffectations(int $productID, array $affectations){

		foreach($affectations as $affect) {

			$data = array(
				'id_produit'=>$productID, 
				'id_categorie'=>intval($affect)
			);

			try {
				$db_debug = $this->db->db_debug;
				$this->db->db_debug = FALSE;
				$this->db->insert('affectation', $data);
				$this->db->db_debug = $db_debug;
			} catch (Exception $e) {return null;}
		}
    }
}
?>
