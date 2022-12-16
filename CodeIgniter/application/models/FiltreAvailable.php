<?php
require_once("FiltreDecorator.php");
class FiltreAvailable extends FiltreDecorator {
    private bool $available;

    public function __construct(FiltreInterface $filtre, bool $available) {
        parent::__construct($filtre);
        $this->available = $available;
    }
    public function getFiltres(): array {
        $current = $this->filtre->getFiltres();
        $current['available'] = $this->available;
        return $current;
    }
}
?>