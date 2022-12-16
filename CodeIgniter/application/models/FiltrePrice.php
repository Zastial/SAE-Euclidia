<?php
require_once("FiltreDecorator.php");
class FiltrePrice extends FiltreDecorator {
    private int $minPrice;
    private int $maxPrice;

    public function __construct(FiltreInterface $filtre, $minPrice, $maxPrice) {
        parent::__construct($filtre);
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }
    public function getFiltres(): array {
        $current = $this->filtre->getFiltres();
        $current['maxPrice'] = $this->maxPrice;
        $current['minPrice'] = $this->minPrice;
        return $current;
    }
}
?>