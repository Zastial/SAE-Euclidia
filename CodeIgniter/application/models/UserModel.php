<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."UserEntity.php";
class UserModel extends CI_Model {

    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get_where('utilisateur', array('active' => true));
		$response = $q-> custom_result_object("UserEntity");
		return $response;
    }

	public function findById(string $id): ?UserEntity {
		$this->db->select('*');
		$q = $this->db->get_where('utilisateur',array('id_utilisateur'=>$id));
		$response = $q->row(0,"UserEntity");
		return $response;
	}

    public function findByEmail(string $email): ?UserEntity {
		$this->db->select('*');
		$q = $this->db->get_where('utilisateur',array('email'=>$email));
		$response = $q->row(0,"UserEntity");
		return $response;
    }

	public function getNewId(): int {
		$this->db->select_max('id_utilisateur');
		$this->db->from("utilisateur");
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row('id_utilisateur') + 1;
		}
		return 0;
	}

	public function addUser(UserEntity $user): ?UserEntity {
		$nom = $user->getNom();
		$prenom = $user->getPrenom();
		$email = $user->getEmail();
		$id = $user->getId();
		$password = $user->getPassword();
		$status = $user->getStatus();

		$data = array('id_utilisateur' => $id, 
		'prenom' => $prenom, 
		'nom' => $nom, 
		'password' => $password, 
		'email' => $email,
		 'status' => $status);
		
		try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->insert('utilisateur', $data);
			$this->db->db_debug = $db_debug;
		} catch (Exception $e) {}

		return $this->findById($id);
	}

}
?>
