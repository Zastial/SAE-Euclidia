<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FactureEntity.php";
class FactureModel extends CI_Model {
   
    /**
     * La fonction findByUser permet de trouver les factures liées a un utilisateur via son ID
     * 
     * @param int |$id
     */
    public function findByUser(int $id) {
        $this->db->select('*');
		$q = $this->db->get_where('facture', array("id_utilisateur"=>$id));
		$response = $q->custom_result_object("FactureEntity");
		return $response;
    }

    /**
     * La fonction findById permet de trouver une facture via son ID
     * 
     * @param int |$id
     * 
     * @return ?FactureEntity
     */
    public function findById(int $id): ?FactureEntity{
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

		return $f;
    }

    /**
     * La fonction addFacture permet d'ajouter une facture lorsque un achat est effectué
     * 
     * @param FactureEntity | $f
     * 
     * @return ?FactureEntity
     */
    public function addFacture(FactureEntity $f): ?FactureEntity{
        try{
            $this->db->trans_start();
            $q = $this->db->query("CALL addFacture(?,?,?,?,?,?,?,?,?,@result)", array($f->getDate(),$f->getTotal(),$f->getUserId(),$f->getAdresse(),$f->getNumeroRue(),$f->getPays(),$f->getVille(),$f->getCodePostal(),$f->getPaiement()));
            $qu = $this->db->query("SELECT @result as res");
            $this->db->trans_complete();
        } catch (Exception $e){
            var_dump($e);
        }

        $q = $this->db->get_where('facture', array('id_facture' => intval($qu->row_array(0)["res"])));
        $response = $q->row(0,"FactureEntity");
        return $response;
    }
}
?>
