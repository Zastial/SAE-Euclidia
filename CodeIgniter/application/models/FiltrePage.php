<?php
require_once("FiltreDecorator.php");
class FiltrePage extends FiltreDecorator {
    private string $page;

    public function __construct(FiltreInterface $filtre, $page) {
        parent::__construct($filtre);
        $this->page = $page;
    }
    public function getFiltres(): array {
        $current = $this->filtre->getFiltres();
        $current['page'] = $this->page;
        return $current;
    }
}
?>