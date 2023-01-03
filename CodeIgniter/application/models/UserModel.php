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
		try{
			$q = $this->db->query("CALL addUser(?,?,?,?,?,'NON DEFINI','NON DEFINI','NON DEFINI','00000','NON DEFINI')", array($user->getNom(), $user->getPrenom(), $user->getPassword(), $user->getEmail(), $user->getStatus()));
		} catch (Exception $e){
			var_dump($e);
			return null;
		}
		return $this->findByEmail($user->getEmail());
	}
	
	public function updateUser(UserEntity $user): ?UserEntity{
		try{
			$q = $this->db->query("CALL updateUser(?,?,?,?,?,?,?,?,?,?,?)", array($user->getId(), $user->getNom(), $user->getPrenom(), $user->getPassword(), $user->getEmail(), $user->getStatus(), $user->getNumRue(), $user->getAdresse(), $user->getVille(), $user->getPostalCode(), $user->getPays()));
		} catch (Exception $e){
			return null;
		}

		return $this->findById($user->getId());
	}

	public function activeUser(UserEntity $user) : ?UserEntity {
		try{
			$q = $this->db->query("CALL activeUser(?,?)", array($user->getId(), $user->getEtat()));
		} catch (Exception $e){
			return null;
		}

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
