<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."ReductionEntity.php";
class ReductionModel extends CI_Model {
    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get('reduction');
		$response = $q-> custom_result_object("ReductionEntity");
		return $response;
    }

    public function findByCode($code){
        $this->db->select('*');
        $params = array('code'=>$code);
		$q = $q = $this->db->get_where('reduction', $params);
		$response = $q->row(0,"ReductionEntity");
		return $response;
    }
}
?>
