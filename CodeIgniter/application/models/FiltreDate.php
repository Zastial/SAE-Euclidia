<?php
require_once("FiltreDecorator.php");
class FiltreDate extends FiltreDecorator {
    private string $minDate;
    private string $maxDate;

    public function __construct(FiltreInterface $filtre, $minDate, $maxDate) {
        parent::__construct($filtre);
        $this->minDate = $minDate;
        $this->maxDate = $maxDate;
    }
    public function getFiltres(): array {
        $current = $this->filtre->getFiltres();
        $current['minDate'] = $this->minDate;
        $current['maxDate'] = $this->maxDate;
        return $current;
    }
}
?>