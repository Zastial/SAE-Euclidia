<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FactureEntity.php";
class FactureModel extends CI_Model {
   
    public function findByUser($id) {
        $this->db->select('*');
		$q = $this->db->get_where('facture', array("id_utilisateur"=>$id));
		$response = $q->custom_result_object("FactureEntity");
		return $response;
    }

    public function addFacture(FactureEntity $f): ?FactureEntity{
        $data = array(
            "date_facture" => $f->getDate(),
            "total" => $f->getTotal(),
            "id_utilisateur" => $f->getUserId(),
            "adresse" => $f->getAdresse(),
            "numero_rue" => $f->getNumeroRue(),
            "pays" => $f->getPays(),
            "ville" => $f->getVille(),
            "code_postal" => $f->getCodePostal(),
            "paiement" => $f->getPaiement(),
            "reduction" => $f->getReduction()
        );

        try {
			$db_debug = $this->db->db_debug;
			$this->db->db_debug = FALSE;
			$this->db->insert('facture', $data);
			$this->db->db_debug = $db_debug;
		} catch (Exception $e) {return null;}

        $id = $this->db->insert_id();
        $q = $this->db->get_where('facture', array('id_facture' => $id));
        $response = $q->row(0,"FactureEntity");
        return $response;
    }
}
?>
