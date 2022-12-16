<?php
require_once("FiltreDecorator.php");
class FiltreCategories extends FiltreDecorator {
    private array $categories;

    public function __construct(FiltreInterface $filtre, $categories) {
        parent::__construct($filtre);
        $this->categories = $categories;
    }
    public function getFiltres(): array {
        $current = $this->filtre->getFiltres();
        $current['categories'] = $this->categories;
        return $current;
    }
}
?>