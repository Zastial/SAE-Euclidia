<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."UserEntity.php";
class UserModel extends CI_Model {

    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get_where('utilisateur');
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

	public function addUser(UserEntity $user): ?UserEntity {
		$nom = $user->getNom();
		$prenom = $user->getPrenom();
		$email = $user->getEmail();
		$password = $user->getPassword();
		$status = $user->getStatus();

		$data = array(
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
		} catch (Exception $e) {return null;}

		// get last inserted row
		$id = $this->db->insert_id();
		$q = $this->db->get_where('utilisateur', array('id_utilisateur' => $id));
		$response = $q->row(0,"UserEntity");
		return $response;
	}
	
	public function updateUser(UserEntity $user): ?UserEntity{
		try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->set('prenom', $user->getPrenom());		// This is:
			$this->db->set('nom', $user->getNom());				// UPDATE utilisateur
			$this->db->set('email', $user->getEmail());			// SET `prenom` = $user->getPrenom(), `nom` = $user->getNom(), `email` = $user->getEmail(), `password` = $user->getPassword
			$this->db->set('password', $user->getPassword());	// WHERE `id_utilisateur` = $user->getID();
			$this->db->where('id_utilisateur', $user->getId());	// To prevent data from being escaped, set $escape to FALSE in the set() functions.
			$result = $this->db->update('utilisateur');			// See https://codeigniter.com/userguide3/database/query_builder.html#updating-data for more detail.
			$this->db->db_debug = $db_debug;					// Note that while set() accepts an object, we can't do that here because our objects have IDs in them, and we don't want to change that :)

			if (!$result) {
				return null;
			}
		} catch (Exception $e) {return null;} 
		return $this->findById($user->getId());
	}
}
?>
