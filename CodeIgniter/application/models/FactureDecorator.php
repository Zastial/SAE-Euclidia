<?php
require_once("FactureInterface.php");
abstract class FactureDecorator implements FactureInterface {
    protected FactureEntity $facture;
    
    public function __construct(FactureInterface $facture) {
        $this->facture = $facture;
    }
}
?>
