<?php
require_once("FactureDecorator.php");

class FactureReduction extends FactureDecorator {
    private $reduction;
    
    public function __construct(FactureInterface $facture, $reduction) {
        parent::__construct($facture);
        $this->reduction = $reduction;
    }

    public function getTotal(): float {
        return $this->facture->getTotal() * (1 - ($this->reduction/100));
    }

    public function getReduction() {
        return $this->reduction;
    }

    public function getId(): int {
        return $this->facture->getId();
    }

    public function getDate(): string {
        return $this->facture->getDate();
    }

    public function getUserId(): int {
        return $this->facture->getUserId();
    }

    public function getAdresse(): string {
        return $this->facture->getAdresse();
    }

    public function getNumeroRue(): int {
        return $this->facture->getNumeroRue();
    }

    public function getPays(): string {
        return $this->facture->getPays();
    }

    public function getVille(): string {
        return $this->facture->getVille();
    }

    public function getCodePostal(): int {
        return $this->facture->getCodePostal();
    }

    public function getPaiement(): string {
        return $this->facture->getPaiement();
    }



    public function setId(int $id) {
        $this->facture->setId($id);
    }

    public function setDate(string $date) {
        $this->facture->setDate($date);
    }

    public function setTotal(float $total) {
        $this->facture->setTotal($total);
    }

    public function setUserId(int $userid) {
        $this->facture->setUserId($userid);
    }

    public function setAdresse(string $adresse) {
        $this->facture->setAdresse($adresse);
    }

    public function setNumeroRue(int $numero_rue) {
        $this->facture->setNumeroRue($numero_rue);
    }

    public function setPays(string $pays) {
        $this->facture->setPays($pays);
    }

    public function setVille(string $ville) {
        $this->facture->setVille($ville);
    }

    public function setCodePostal(int $code_postal) {
        $this->facture->setCodePostal($code_postal);
    }

    public function setPaiement(string $paiement) {
        $this->facture->setPaiement($paiement);
    }

}
?>