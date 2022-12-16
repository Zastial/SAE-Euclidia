<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."UserEntity.php";
class UserModel extends CI_Model {

    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get_where('utilisateur');

		$users = array();
		foreach ($q->result() as $row) {
			$status = $row->status;
			$u = UserEntity::getUser($status);
			if ($u == null) {
				continue;
			}
			$u->setId($row->id_utilisateur);
			$u->setNom($row->nom);
			$u->setPrenom($row->prenom);
			$u->setEmail($row->email);
			$u->setEtat($row->etat);
			$u->setNumRue($row->numrue);
			$u->setAdresse($row->adresse);
			$u->setVille($row->ville);
			$u->setPostalCode($row->postalcode);
			$u->setPays($row->pays);

			$users[] = $u;

		}
		return $users;
    }

	public function findById(string $id): ?UserEntity {
		$this->db->select('*');
		$q = $this->db->get_where('utilisateur',array('id_utilisateur'=>$id));
		if (empty($q->result())) {
			return null;
		}
		$row = $q->result()[0];

		$u = UserEntity::getUser($row->status);
		if ($u != null) {
			$u->setId($row->id_utilisateur);
			$u->setNom($row->nom);
			$u->setPrenom($row->prenom);
			$u->setEmail($row->email);
			$u->setEtat($row->etat);
			$u->setNumRue($row->numrue);
			$u->setAdresse($row->adresse);
			$u->setVille($row->ville);
			$u->setPostalCode($row->postalcode);
			$u->setPays($row->pays);
			$u->setPassword($row->password);
		}
		return $u;
	}

    public function findByEmail(string $email): ?UserEntity {
		$this->db->select('*');
		$q = $this->db->get_where('utilisateur',array('email'=>$email));
		if (empty($q->result())) {
			return null;
		}
		$row = $q->result()[0];

		$u = UserEntity::getUser($row->status);
		if ($u != null) {
			$u->setId($row->id_utilisateur);
			$u->setNom($row->nom);
			$u->setPrenom($row->prenom);
			$u->setEmail($row->email);
			$u->setEtat($row->etat);
			$u->setNumRue($row->numrue);
			$u->setAdresse($row->adresse);
			$u->setVille($row->ville);
			$u->setPostalCode($row->postalcode);
			$u->setPays($row->pays);
			$u->setPassword($row->password);
		}
		return $u;
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
		'status' => $status,
		'numrue' => 'NON DEFINI',
		'adresse' => 'NON DEFINI',
		'ville' => 'NON DEFINI',
		'postalcode' => 'NON DEFINI',
		'pays' => 'NON DEFINI');
		
		try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->insert('utilisateur', $data);
			$this->db->db_debug = $db_debug;
		} catch (Exception $e) {return null;}

		return $this->findByEmail($email);
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

	public function activeUser(UserEntity $user) : ?UserEntity {
		try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->set('etat', $user->getEtat());
			$this->db->where('id_utilisateur', $user->getId());
			$result = $this->db->update('utilisateur');
			$this->db->db_debug = $db_debug;
			if (!$result) {
				return null;
			}
		} catch (Exception $e) {return null;} 
		return $this->findById($user->getId());
	}


	public function isActive(UserEntity $user): bool {
		$this->db->select('etat');
		$q = $this->db->get_where('utilisateur',array('id_utilisateur'=>$user->getId()));
		$row = $q->result();

		return $row[0]->etat == "active";
	}

}
?>
