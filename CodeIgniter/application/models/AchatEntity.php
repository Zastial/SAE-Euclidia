<?php
class AchatEntity {

    private int $id_produit;
    private int $id_facture;
    private float $prix;
   
    /**
     * @return int
     */
    public function getIdProduit(): int {
        return $this->id_produit;
    }

    /**
     * @return int
     */
    public function getIdFacture(): int {
        return $this->id_facture;
    }

    /**
     * @return float
     */
    public function getPrix(): float {
        return $this->prix;
    }


    /**
     * @param int $id
     */
    public function setIdProduit(int $id): void {
        $this->id_produit = $id;
    }

    /**
     * @param int $id
     */
    public function setIdFacture(int $id): void {
        $this->id_facture = $id;
    }

    /**
     * @param float $prix
     */
    public function setPrix(float $prix): void {
        $this->prix = $prix;
    }

}
?>