<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."CategorieEntity.php";
class FactureModel extends CI_Model {
   
    public function findByUser($id) {
        $this->db->select('*');
		$q = $this->db->get_where('facture', array("id_utilisateur"=>$id));
		$response = $q->custom_result_object("FactureEntity");
		return $response;
    }

    
}
?>
