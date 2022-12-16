<?php
class FactureEntity {

    private int $id_facture;
    private string $date_facture;
    private float $total;
    private int $id_utilisateur;
    private string $adresse;
    private int $numero_rue;
    private string $pays;
    private string $ville;
    private int $code_postal;
    private string $paiement;


    /**
	 * @return int
	 */
    public function getId(): int {
        return $this->id_facture;
    }

    /**
	 * @return string
	 */
    public function getDate(): string {
        return $this->date_facture;
    }

    /**
	 * @return float
	 */
    public function getTotal(): float {
        return $this->total;
    }

    /**
	 * @return int
	 */
    public function getUserId(): int {
        return $this->id_utilisateur;
    }

    /**
	 * @return string
	 */
    public function getAdresse(): string{
        return $this->adresse;
    }

    /**
	 * @return int
	 */
    public function getNumeroRue(): int{
        return $this->numero_rue;
    }

    /**
	 * @return string
	 */
    public function getPays():string{
        return $this->pays;
    }

    /**
	 * @return string
	 */
    public function getVille():string{
        return $this->ville;
    }

    /**
	 * @return int
	 */
    public function getCodePostal():int{
        return $this->code_postal;
    }

    /**
	 * @return string
	 */
    public function getPaiement(): string{
        return $this->paiement;
    }

    /**
	 * @param int $id
	 */
    public function setId(int $id): void {
        $this->id_facture = $id;
    }
    
    /**
	 * @param string $date
	 */
    public function setDate(string $date): void {
        $this->date_facture = $date;
    }

    /**
	 * @param float $total
	 */
    public function setTotal(float $total): void {
        $this->total = $total;
    }

    /**
	 * @param int $userid
	 */
    public function setUserId(int $userid) {
        $this->id_utilisateur = $userid;
    }

    /**
	 * @param string $adresse
	 */
    public function setAdresse(string $adresse){
        $this->adresse = $adresse;
    }

    /**
	 * @param int $numero_rue
	 */
    public function setNumeroRue(int $numero_rue){
        $this->numero_rue = $numero_rue;
    }

    /**
	 * @param string $pays
	 */
    public function setPays(string $pays){
        $this->pays = $pays;
    }

    /**
	 * @param string $ville
	 */
    public function setVille(string $ville){
        $this->ville = $ville;
    }

    /**
	 * @param int $code_postal
	 */
    public function setCodePostal(int $code_postal){
        $this->code_postal = $code_postal;
    }

    /**
	 * @param string $paiement
	 */
    public function setPaiement(string $paiement){
        $this->paiement = $paiement;
    }
}
?>
