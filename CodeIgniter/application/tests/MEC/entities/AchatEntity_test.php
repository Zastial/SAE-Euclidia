<?php

class AchatEntity_test extends UnitTestCase {

    public function testSetIdProduit()
    {
        $achat = new AchatEntity();
        $achat->setIdProduit(1);
        $this->assertEquals(1, $achat->getIdProduit());
    }

    public function testSetIdFacture()
    {
        $achat = new AchatEntity();
        $achat->setIdFacture(1);
        $this->assertEquals(1, $achat->getIdFacture());
    }

    public function testSetPrix()
    {
        $achat = new AchatEntity();
        $achat->setPrix(50.00);
        $this->assertEquals(50.00, $achat->getPrix());
    }

}