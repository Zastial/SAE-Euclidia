<?php

class AffectationEntity_test extends UnitTestCase {

    public function testSetIdProduit()
    {
        $affectation = new AffectationEntity();
        $affectation->setIdProduit(1);
        $this->assertEquals(1, $affectation->getIdProduit());
    }

    public function testSetIdCategorie()
    {
        $affectation = new AffectationEntity();
        $affectation->setIdCategorie(1);
        $this->assertEquals(1, $affectation->getIdCategorie());
    }

}