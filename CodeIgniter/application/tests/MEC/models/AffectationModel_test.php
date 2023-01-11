<?php

class AffectationModel_test extends UnitTestCase {

    public static function setUpBeforeClass() : void
	{
		parent::setUpBeforeClass();

		$CI =& get_instance();
		$CI->load->library('Seeder');
		$CI->seeder->call('UserSeeder');
		$CI->seeder->call('ProductSeeder');
		$CI->seeder->call('CategorieSeeder');
		$CI->seeder->call('AffectationSeeder');
		$CI->seeder->call('FactureSeeder');
		$CI->seeder->call('AchatSeeder');
	}

    public function setUp() : void
	{
		$this->obj = $this->newModel('AffectationModel');
		$CI =& get_instance();
		$this->obj->db = $CI->load->database('tests', TRUE);
	}

    public function test_findAll() 
    {
		$list = $this->obj->findAll();
		$expected = array(
            [
                'id_produit' => '1',
                'id_categorie' => '1',
            ],
            [
                'id_produit' => '2',
                'id_categorie' => '1',
    
            ],
            [
                'id_produit' => '2',
                'id_categorie' => '2',
    
            ],
			[
                'id_produit' => '3',
                'id_categorie' => '2',
    
            ]

		);

		$this->assertEquals(count($list), count($expected));

		for ($i = 0; $i < count($list); $i++) {
			$affecte = $list[$i];
			$this->assertTrue(is_a($affecte, "AffectationEntity"));
			$this->assertEquals($affecte->getIdProduit(), $expected[$i]['id_produit']);
            $this->assertEquals($affecte->getIdCategorie(), $expected[$i]['id_categorie']);
		}
    }

    public function test_findByIdProduct() {
		$expected =['id_produit' => '1', 'id_categorie' => '1',];

		$affectation = $this->obj->findByIdProduct(1)[0];

		$this->assertTrue(is_a($affectation, "AffectationEntity"));
        $this->assertEquals($affectation->getIdProduit(), $expected['id_produit']);
        $this->assertEquals($affectation->getIdCategorie(), $expected['id_categorie']);
	}

    public function test_findByIdCategorie() {
		$expected = array(['id_produit' => '2', 'id_categorie' => '2'],
        ['id_produit' => '3', 'id_categorie' => '2']);

		$affectation = $this->obj->findByIdCategorie(2);

        for($i=0;$i<count($expected);$i++) {
            $this->assertTrue(is_a($affectation[$i], "AffectationEntity"));
            $this->assertEquals($affectation[$i]->getIdProduit(), $expected[$i]['id_produit']);
            $this->assertEquals($affectation[$i]->getIdCategorie(), $expected[$i]['id_categorie']);
        }
	}

	public function test_addAffectations() {
		$expected =['id_produit' => '3', 'id_categorie' => '3',];

        $this->obj->addAffectations(3,array(3));

        $affectation = $this->obj->findByIdCategorie(3)[0];

		$this->assertTrue(is_a($affectation, "AffectationEntity"));
        $this->assertEquals($affectation->getIdProduit(), $expected['id_produit']);
        $this->assertEquals($affectation->getIdCategorie(), $expected['id_categorie']);
	}

    public function test_removeAffectations() {

        $this->obj->removeAffectations(3,array(3));

        $affectation = $this->obj->findByIdCategorie(3);

        $this->assertTrue(empty($affectation));
    }

}