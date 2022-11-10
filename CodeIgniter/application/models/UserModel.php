<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."UserEntity.php";
class UserModel extends CI_Model {

    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get('utilisateur');
		$response = $q-> custom_result_object("UserEntity");
		return $response;
    }

    public function findByEmail(string $email) {
		$this->db->select('*');
		$q = $this->db->get_where('utilisateur',array('email'=>$email));
		$response = $q->row(0,"UserEntity");
		return $response;
    }


}
?>
