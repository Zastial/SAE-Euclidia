<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."CategorieEntity.php";
class CategorieModel extends CI_Model {
    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get('categorie');
		$response = $q->custom_result_object("CategorieEntity");
		return $response;
    }
}
?>
