<?php
require_once("FiltreDecorator.php");
class FiltreName extends FiltreDecorator {
    private string $name;

    public function __construct(FiltreInterface $filtre, $name) {
        parent::__construct($filtre);
        $this->name = $name;
    }
    public function getFiltres(): array {
        $current = $this->filtre->getFiltres();
        $current['name'] = $this->name;
        return $current;
    }
}
?>