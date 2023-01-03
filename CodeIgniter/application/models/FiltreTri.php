<?php
require_once("FiltreDecorator.php");
require_once("Tri.php");

class FiltreTri extends FiltreDecorator {
    private Tri $tri;
    
    public function __construct(FiltreInterface $filtre, Tri $tri) {
        parent::__construct($filtre);
        $this->tri = $tri;
    }
    public function getFiltres(): array {
        $current = $this->filtre->getFiltres();
        $current['tri'] = $this->tri;
        return $current;
    }
}
?>