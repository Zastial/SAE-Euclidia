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
		$this->db->trans_start();
		$success = $this->db->query("CALL boughtFromUser(".$idproduit.", '". $userMail ."', @result );");
		$qu = $this->db->query("SELECT @result as r_1");
		$this->db->trans_complete();
		return intval($qu->row_array(0)["r_1"]) == 1;
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
		try{
			$q = $this->db->query("CALL addAchat(".$achat->getIdProduit().",".$achat->getIdFacture().",".$achat->getPrix().")");
		} catch (Exception $e){
			return false;
		}
		return true;
	}
}
?>
