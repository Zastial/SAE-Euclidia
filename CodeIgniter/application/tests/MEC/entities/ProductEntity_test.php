<?php

class ProductEntity_test extends UnitTestCase {

    public function testSetTitre()
    {
        $produit = new ProductEntity();
        $produit->setTitre('Keyboard');
        $this->assertEquals('Keyboard', $produit->getTitre());
    }

    public function testSetPrix()
    {
        $produit = new ProductEntity();
        $produit->setPrix(50.00);
        $this->assertEquals(50.00, $produit->getPrix());
    }

    public function testSetDescription()
    {
        $produit = new ProductEntity();
        $produit->setDescription('This is a keyboard.');
        $this->assertEquals('This is a keyboard.', $produit->getDescription());
    }

    public function testSetDisponible()
    {
        $produit = new ProductEntity();
        $produit->setDisponible(1);
        $this->assertEquals(1, $produit->getDisponible());
    }
}