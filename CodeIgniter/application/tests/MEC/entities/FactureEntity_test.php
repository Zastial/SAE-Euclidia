<?php

class FactureEntity_test extends UnitTestCase {

    public function testSetDate()
    {
        $facture = new FactureEntity();
        $facture->setDate('2022-01-01 12:00:00');
        $this->assertEquals('2022-01-01 12:00:00', $facture->getDate());
    }

    public function testSetTotal()
    {
        $facture = new FactureEntity();
        $facture->setTotal(100.00);
        $this->assertEquals(100.00, $facture->getTotal());
    }

    public function testSetUserId()
    {
        $facture = new FactureEntity();
        $facture->setUserId(1);
        $this->assertEquals(1, $facture->getUserId());
    }

    public function testSetAdresse()
    {
        $facture = new FactureEntity();
        $facture->setAdresse('123 Main Street');
        $this->assertEquals('123 Main Street', $facture->getAdresse());
    }

    public function testSetNumeroRue()
    {
        $facture = new FactureEntity();
        $facture->setNumeroRue('20');
        $this->assertEquals('20', $facture->getNumeroRue());
    }

    public function testSetPays()
    {
        $facture = new FactureEntity();
        $facture->setPays('France');
        $this->assertEquals('France', $facture->getPays());
    }

    public function testSetVille()
    {
        $facture = new FactureEntity();
        $facture->setVille('Nantes');
        $this->assertEquals('Nantes', $facture->getVille());
    }

    public function testSetCodePostal()
    {
        $facture = new FactureEntity();
        $facture->setCodePostal(44300);
        $this->assertEquals(44300, $facture->getCodePostal());
    }

    public function testSetPaiement()
    {
        $facture = new FactureEntity();
        $facture->setPaiement('Paypal');
        $this->assertEquals('Paypal', $facture->getPaiement());
    }

}