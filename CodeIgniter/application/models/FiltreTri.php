<?php
require_once("FiltreDecorator.php");
class FiltreTri extends FiltreDecorator {
    private string $tri;
    public function __construct(FiltreInterface $filtre, $tri) {
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