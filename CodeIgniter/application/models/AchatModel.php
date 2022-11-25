<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."AchatEntity.php";
class AchatModel extends CI_Model {

    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get_where('achat');
		$response = $q-> custom_result_object("AchatEntity");
		return $response;
    }

    public function findById(string $idUser) {
		$this->db->select('*');
		$q = $this->db->get_where('achat',array('id_utilisateur'=>$idUser));
		$response = $q->custom_result_object("AchatEntity");
		return $response;
	}

	public function boughtFromUser(int $idproduit, string $userMail): bool {
		$this->db->select('achat.id_produit');
		$this->db->from('achat');
		$this->db->join('facture', 'facture.id_facture = achat.id_facture');
		$this->db->join('utilisateur', 'utilisateur.id_utilisateur = facture.id_utilisateur');
		$this->db->where(array('id_produit'=>$idproduit, 'email'=>$userMail));
		$q = $this->db->get();
		return $q->num_rows() > 0;
	}

	public function addAchat(AchatEntity $achat): bool {
		$data = array(
		'id_produit' => $achat->getIdProduit(), 
		'id_facture' => $achat->getIdFacture(),
		'prix' => $achat->getPrix()
		);
		
		try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->insert('achat', $data);
			$this->db->db_debug = $db_debug;
		} catch (Exception $e) {return false;}

		return true;
	}
}
?>
