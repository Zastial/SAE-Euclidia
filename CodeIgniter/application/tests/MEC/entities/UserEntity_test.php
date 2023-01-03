<?php
class UserEntity_test extends UnitTestCase {

    public function testSetPrenom()
    {
        $utilisateur = new UserAdmin();
        $utilisateur->setPrenom('John');
        $this->assertEquals('John', $utilisateur->getPrenom());
    }

    public function testSetNom()
    {
        $utilisateur = new UserAdmin();
        $utilisateur->setNom('Doe');
        $this->assertEquals('Doe', $utilisateur->getNom());
    }

    public function testSetPassword()
    {
        $utilisateur = new UserAdmin();
        $utilisateur->setPassword('password123');
        $this->assertEquals('password123', $utilisateur->getPassword());
    }

    public function testSetEmail()
    {
        $utilisateur = new UserAdmin();
        $utilisateur->setEmail('john.doe@example.com');
        $this->assertEquals('john.doe@example.com', $utilisateur->getEmail());
    }
    
    public function testSetNumRue()
    {
        $utilisateur = new UserAdmin();
        $utilisateur->setNumRue('123');
        $this->assertEquals('123', $utilisateur->getNumRue());
    }

    public function testSetAdresse()
    {
        $utilisateur = new UserAdmin();
        $utilisateur->setAdresse('123 Main Street');
        $this->assertEquals('123 Main Street', $utilisateur->getAdresse());
    }

    public function testSetVille()
    {
        $utilisateur = new UserAdmin();
        $utilisateur->setVille('New York');
        $this->assertEquals('New York', $utilisateur->getVille());
    }

    public function testSetPostalCode()
    {
        $utilisateur = new UserAdmin();
        $utilisateur->setPostalCode('10001');
        $this->assertEquals('10001', $utilisateur->getPostalCode());
    }

    public function testSetPays()
    {
        $utilisateur = new UserAdmin();
        $utilisateur->setPays('United States');
        $this->assertEquals('United States', $utilisateur->getPays());
    }

    public function testSetEtat()
    {
        $utilisateur = new UserAdmin();
        $utilisateur->setEtat('active');
        $this->assertEquals('active', $utilisateur->getEtat());
    }
}
?>