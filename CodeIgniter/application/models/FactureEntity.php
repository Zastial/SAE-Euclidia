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
    private int $reduction;


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

    public function getAdresse(): string{
        return $this->adresse;
    }

    public function getNumeroRue(): int{
        return $this->numero_rue;
    }

    public function getPays():string{
        return $this->pays;
    }

    public function getVille():string{
        return $this->ville;
    }

    public function getCodePostal():int{
        return $this->code_postal;
    }

    public function getPaiement(): string{
        return $this->paiement;
    }

    public function getReduction():int{
        return $this->reduction;
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
    public function setUserId(int $userid): void {
        $this->id_utilisateur = $userid;
    }

    public function setAdresse(string $adresse){
        $this->adresse = $adresse;
    }

    public function setNumeroRue(int $numero_rue){
        $this->numero_rue = $numero_rue;
    }

    public function setPays(string $pays){
        $this->pays = $pays;
    }

    public function setVille(string $ville){
        $this->ville = $ville;
    }

    public function setCodePostal(int $code_postal){
        $this->code_postal = $code_postal;
    }

    public function setPaiement(string $paiement){
        $this->paiement = $paiement;
    }

    public function setReduction(int $reduction){
        $this->reduction = $reduction;
    }
}
?>
