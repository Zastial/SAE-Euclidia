<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."AchatEntity.php";
class AchatModel extends CI_Model {


	/**
	 * La fonction findAll permet de récupérer tout les Achats dans la base de donnée 'achat'
	 */
    public function findAll() {
		$this->db->select('*');
		$q = $this->db->get_where('achat');
		$response = $q-> custom_result_object("AchatEntity");
		return $response;
    }

	/**
	 * La fonction findById permet de récupérer un achat en fonction de l'id de la facture
	 * 
	 * @param int | $idFacture
	 * 
	 */
    public function findById($idFacture) {
		$this->db->select('*');
		$q = $this->db->get_where('achat',array('id_facture'=>$idFacture));
		$response = $q->custom_result_object("AchatEntity");
		return $response;
	}

	/**
	 * La fonction boughtFromUser permet de vérifier si un produit a bel et bien été acheté par un utilisateur
	 * 
	 * @param int | $idproduit
	 * @param string | $userMail
	 * 
	 * @return bool
	 * 
	 */
	public function boughtFromUser(int $idproduit, string $userMail): bool {
		$this->db->select('achat.id_produit');
		$this->db->from('achat');
		$this->db->join('facture', 'facture.id_facture = achat.id_facture');
		$this->db->join('utilisateur', 'utilisateur.id_utilisateur = facture.id_utilisateur');
		$this->db->where(array('id_produit'=>$idproduit, 'email'=>$userMail));
		$q = $this->db->get();
		return $q->num_rows() > 0;
	}


	/**
	 * La fonction permet d'ajouter un achat effectué, la fonction retourne True si l'ajout est réussi
	 * 
	 * @param AchatEntity | $achat
	 * 
	 * @return bool
	 * 
	 */
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
