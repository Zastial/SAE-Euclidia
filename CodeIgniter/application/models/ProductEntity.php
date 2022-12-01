<?php
class ProductEntity {

    private int $id_produit;
    private string $titre;
    private float $prix;
    private string $description;
    private bool $disponible;

    /**
	 * @return int
	 */
    public function getId(): int {
        return $this->id_produit;
    }

    /**
	 * @return string
	 */
    public function getTitre(): string {
        return $this->titre;
    }

    /**
	 * @return float
	 */
    public function getPrix(): float {
        return $this->prix;
    }

    /**
	 * @return string
	 */
    public function getDescription(): string {
        return $this->description;
    }

    /**
	 * @return bool
	 */
    public function getDisponible(): bool {
        return $this->disponible;
    }

    /**
	 * @param int $id
	 */
    public function setId(int $id): void {
        $this->id_produit = $id;
    }

    /**
	 * @param string $titre
	 */
    public function setTitre(string $titre): void {
        $this->titre = $titre;
    }

    /**
	 * @param float $prix
	 */
    public function setPrix(float $prix): void {
        $this->prix = $prix;
    }

    /**
	 * @param string $description
	 */
    public function setDescription(string $description): void {
        $this->description = $description;
    }

    /**
	 * @param bool $prix
	 */
    public function setDisponible(bool $disponible): void {
        $this->disponible = $disponible;
    }
}

?>
