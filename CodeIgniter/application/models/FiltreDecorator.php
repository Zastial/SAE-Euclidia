<?php
require_once("FiltreInterface.php");
abstract class FiltreDecorator implements FiltreInterface {
    protected FiltreInterface $filtre;
    
    public function __construct(FiltreInterface $filtre) {
        $this->filtre = $filtre;
    }
}
?>
