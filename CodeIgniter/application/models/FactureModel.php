<?php
require_once APPPATH.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR."FactureEntity.php";
class FactureModel extends CI_Model {
   
    public function findAll() {
        $this->db->select('*');
        $q = $this->db->get('facture');
		$response = $q->custom_result_object("FactureEntity");
		return $response;
    }
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

    public function findQueryBuilder(FiltreInterface $filtre, int $userid=null) {
        $filtres = $filtre->getFiltres();
        try {
            $this->db->select('*');
            $this->db->from('facture');

            if ($userid != null) {
                $this->db->where('facture.id_utilisateur =', $userid);
            }

            if (isset($filtres["minDate"]) && !empty($filtres["minDate"])) {
                $this->db->where('facture.date_facture >=', $filtres["minDate"]);
            }

            
            if (isset($filtres["maxDate"]) && !empty($filtres["maxDate"])) {
                $this->db->where('facture.date_facture <=', $filtres["maxDate"]. " 23:59:59.999");
            }

            if (isset($filtres["tri"])) {
                switch($filtres["tri"]) {
                    case Tri::NOMCROISSANT:
                        $this->db->order_by('facture.id_utilisateur', 'asc');
                        break;
                    case Tri::NOMDECROISSANT:
                        $this->db->order_by('facture.id_utilisateur', 'desc');
                        break;
                }
            }
            
            if (isset($filtres["prix"])) {
                switch ($filtres["prix"]) {
                    case Tri::NOMCROISSANT:
                        $this->db->order_by('facture.total', 'asc');
                        break;
                    case Tri::NOMDECROISSANT:
                        $this->db->order_by('facture.total', 'desc');
                        break;
                }
            }

            if (isset($filtres["date"])) {
                switch ($filtres["date"]) {
                    case Tri::NOMCROISSANT:
                        $this->db->order_by('facture.date_facture', 'asc');
                        break;
                    case Tri::NOMDECROISSANT:
                        $this->db->order_by('facture.date_facture', 'desc');
                        break;
                }
            }

            $query = $this->db->get();
			$response = $query->custom_result_object("FactureEntity");
			return $response;
            
        } catch (Exception $e) {
            return null;
        }
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
