<?php

class CategorieModel_test extends UnitTestCase {

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
		$this->obj = $this->newModel('CategorieModel');
		$CI =& get_instance();
		$this->obj->db = $CI->load->database('tests', TRUE);
	}

    public function test_findAll() 
    {
		$list = $this->obj->findAll();
		$expected = array(
			[
                'libelle' => 'avion',
			],
			[
				'libelle' => 'high-tech',
			],
			[
				'libelle' => 'meuble',
			]
		);

		$this->assertEquals(count($list), count($expected));

		for ($i = 0; $i < count($list); $i++) {
			$cate = $list[$i];
			$this->assertTrue(is_a($cate, "CategorieEntity"));
			$this->assertEquals($cate->getLibelle(), $expected[$i]['libelle']);
		}
    }

	public function test_findById() {
		$expected =['libelle' => 'meuble'];

		$cate = $this->obj->findById(1);

		$this->assertTrue(is_a($cate, "CategorieEntity"));
        $this->assertEquals($cate->getLibelle(), $expected['libelle']);
	}

    public function test_findQueryBuilder() {
		$expected =['libelle' => 'high-tech'];

		$filtre = new FiltreName(new Filtre(),"tech");
		$list = $this->obj->findQueryBuilder($filtre);

		$this->assertTrue(is_a($list[0], "CategorieEntity"));
        $this->assertEquals($list[0]->getLibelle(), $expected['libelle']);
	}

	public function test_addCategorie() {
		$expected =['libelle' => 'cat1'];

		$cat = new CategorieEntity();
        $cat->setLibelle("cat1");

        $this->obj->addCategorie($cat);

		$filtre = new FiltreName(new Filtre(),"cat");
		$list = $this->obj->findQueryBuilder($filtre);

		$this->assertTrue(is_a($list[0], "CategorieEntity"));
        $this->assertEquals($list[0]->getLibelle(), $expected['libelle']);
	}

    public function test_updateCategorie() {
		$expected =['libelle' => 'dog2'];

		$filtre = new FiltreName(new Filtre(),"cat");
        $categorie = $this->obj->findQueryBuilder($filtre)[0];

        $categorie->setLibelle("dog2");
        $this->obj->updateCategorie($categorie);

        $filtre = new FiltreName(new Filtre(),"dog");
        $categorie = $this->obj->findQueryBuilder($filtre)[0];

		$this->assertTrue(is_a($categorie, "CategorieEntity"));
        $this->assertEquals($categorie->getLibelle(), $expected['libelle']);
	}

    public function test_removeCategorie() {
		$expected =['libelle' => 'cat2'];

		$cat = new CategorieEntity();
        $cat->setLibelle("cat2");
        $this->obj->addCategorie($cat);

		$filtre = new FiltreName(new Filtre(),"cat");
		$categorie = $this->obj->findQueryBuilder($filtre)[0];
        $this->assertEquals($categorie->getLibelle(), $expected['libelle']);


        $this->obj->removeCategorie($categorie->getID());
        $filtre = new FiltreName(new Filtre(),"cat");
		$categorie = $this->obj->findQueryBuilder($filtre);
        $this->assertTrue(empty($categorie));
	}

    public function test_findByModelId() {
        $expected = ['libelle' => 'meuble'];

        $categorie = $this->obj->findByModelId(1)[0];

        $this->assertEquals($categorie->getLibelle(),$expected['libelle']);
    }

}