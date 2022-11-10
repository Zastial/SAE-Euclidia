<?php
class CategorieEntity {

    private int $id;
    private string $libelle;

    /**
	 * @return int
	 */
    public function getId(): int {
        return $this->id;
    }

    /**
	 * @return string
	 */
    public function getLibelle(): string {
        return $this->libelle;
    }

    /**
	 * @param int $id
	 */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
	 * @param string $libelle
	 */
    public function setLibelle(string $libelle): void {
        $this->libelle = $libelle;
    }
    
}
?>