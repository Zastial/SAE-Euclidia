<?php
require_once("FiltreDecorator.php");
require_once("Tri.php");

class FiltreTri extends FiltreDecorator {
    private Tri $tri;
    private string $key;

    public function __construct(FiltreInterface $filtre, Tri $tri, string $key="tri") {
        parent::__construct($filtre);
        $this->tri = $tri;
        $this->key = $key;
    }
    public function getFiltres(): array {
        $current = $this->filtre->getFiltres();
        $current[$this->key] = $this->tri;
        return $current;
    }
}
?>