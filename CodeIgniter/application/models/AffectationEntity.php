<?php
class AffectationEntity {

    private int $id_produit;
    private string $id_categorie;
   
    /**
     * @return int
     */
    public function getIdProduit(): int {
        return $this->id_produit;
    }

    /**
     * @return string
     */
    public function getIdCategorie(): string {
        return $this->id_categorie;
    }


    /**
     * @param int $id
     */
    public function setIdProduit(int $id): void {
        $this->id_produit = $id;
    }

    /**
     * @param string $nom
     */
    public function setIdCategorie(int $id): void {
        $this->id_categorie = $id;
    }

}
?>