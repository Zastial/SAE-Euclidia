<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FactureEntity.php";
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FactureReduction.php";
class FactureModel extends CI_Model {
   
    public function findByUser($id) {
        $this->db->select('*');
		$q = $this->db->get_where('facture', array("id_utilisateur"=>$id));

        $factures = array();
        foreach ($q->result() as $row) {
            $reduction = $row->reduction;
            
            $f = new FactureEntity();
            $f->setId($row->id_facture);
            $f->setDate($row->date_facture);
            $f->setTotal($row->total);
            $f->setUserId($row->id_utilisateur);
            $f->setAdresse($row->adresse);
            $f->setNumeroRue($row->numero_rue);
            $f->setPays($row->pays);
            $f->setVille($row->ville);
            $f->setCodePostal($row->code_postal);
            $f->setPaiement($row->paiement);

            if ($reduction != 0) {
                $f = new FactureReduction($f, $reduction);
            }
            $factures[] = $f;
        }
        return $factures;
		$response = $q->custom_result_object("FactureEntity");
		return $response;
    }

    public function findById($id){
        $this->db->select('*');
        $q = $this->db->get_where('facture', array('id_facture'=>$id));
        $res = $q->result();
        $reduction = $res[0]->reduction;
        $row = $res[0];
        $f = new FactureEntity();
        $f->setId($row->id_facture);
        $f->setDate($row->date_facture);
        $f->setTotal($row->total);
        $f->setUserId($row->id_utilisateur);
        $f->setAdresse($row->adresse);
        $f->setNumeroRue($row->numero_rue);
        $f->setPays($row->pays);
        $f->setVille($row->ville);
        $f->setCodePostal($row->code_postal);
        $f->setPaiement($row->paiement);

        if ($reduction != 0) {
            $f = new FactureReduction($f, $reduction);
        }
		return $f;
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
            "reduction" => 0
        );

        if (is_a($f, "FactureReduction")) {
            $data["reduction"] = $f->getReduction();
        }

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
