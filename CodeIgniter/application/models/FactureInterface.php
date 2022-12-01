<?php

interface FactureInterface {
    
    public function getId(): int;
    public function getDate(): string;
    public function getTotal(): float;
    public function getUserId(): int;
    public function getAdresse(): string;
    public function getNumeroRue(): int;
    public function getPays():string;
    public function getVille():string;
    public function getCodePostal():int;
    public function getPaiement(): string;

    public function setId(int $id);
    public function setDate(string $date);
    public function setTotal(float $total);
    public function setUserId(int $userid);
    public function setAdresse(string $adresse);
    public function setNumeroRue(int $numero_rue);
    public function setPays(string $pays);
    public function setVille(string $ville);
    public function setCodePostal(int $code_postal);
    public function setPaiement(string $paiement);
}

?>