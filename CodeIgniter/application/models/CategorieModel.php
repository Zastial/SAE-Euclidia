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
	 * @param int $id
	 */
    public function findById(int $id) : ?CategorieEntity{
        $this->db->select('*');
		$params = array('id_categorie'=>$id);
		$q = $q = $this->db->get_where('categorie', $params);
		$response = $q->row(0,"CategorieEntity");
		return $response;
    }


	public function addCategorie(CategorieEntity $categorie):?CategorieEntity{
        $data = array(
			'libelle'=>$categorie->getLibelle());
			
        try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->insert('categorie', $data);
			$this->db->db_debug = $db_debug;
			
		} catch (Exception $e) {return null;}

		// get last inserted row
		$id = $this->db->insert_id();
		$q = $this->db->get_where('categorie', array('id_categorie' => $id));
		$response = $q->row(0,"CategorieEntity");

		return $response;
    }




}
?>
