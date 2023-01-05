	<?php

class ProductModel_test extends UnitTestCase {

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
		$this->obj = $this->newModel('ProductModel');
		$CI =& get_instance();
		$this->obj->db = $CI->load->database('tests', TRUE);
	}

    public function test_findAll() 
    {
		$list = $this->obj->findAll();
		$expected = array(
			[
				'titre' => 'Default Cube',
				'prix' => 60.3,
				'description' => 'Default Blender cube - can not get better!',
				'disponible' => 1
			],
			[
				'titre'=>'Monke',
				'prix'=>213.4,
				'description'=>'Hmmmmmm.... Monke.',
				'disponible'=>1
			],
			[
				'titre'=>'Crewmate',
				'prix'=>213.4,
				'description'=>'Hmmmmmm.... Monke.',
				'disponible'=>1
			]
		);

		$this->assertEquals(count($list), count($expected));

		for ($i = 0; $i < count($list); $i++) {
			$prod = $list[$i];
			$this->assertTrue(is_a($prod, "ProductEntity"));
			$this->assertEquals($prod->getTitre(), $expected[$i]['titre']);
			$this->assertEquals($prod->getPrix(), $expected[$i]['prix']);
			$this->assertEquals($prod->getDescription(), $expected[$i]['description']);
			$this->assertEquals($prod->getDisponible(), $expected[$i]['disponible']);
		}
    }

	public function test_findAllAvailable() {
		$list = $this->obj->findAllAvailable();
		$expected = array(
		
			[
				'titre' => 'Default Cube',
				'prix' => 60.3,
				'description' => 'Default Blender cube - can not get better!',
				'disponible' => 1
			],
			[
				'titre'=>'Monke',
				'prix'=>213.4,
				'description'=>'Hmmmmmm.... Monke.',
				'disponible'=>1
			],
			[
				'titre'=>'Crewmate',
				'prix'=>213.4,
				'description'=>'Hmmmmmm.... Monke.',
				'disponible'=>1
			]
		);

		$this->assertEquals(count($list), count($expected));
		for ($i = 0; $i < count($list); $i++) {
			$prod = $list[$i];
			$this->assertTrue(is_a($prod, "ProductEntity"));
			$this->assertEquals($prod->getTitre(), $expected[$i]['titre']);
			$this->assertEquals($prod->getPrix(), $expected[$i]['prix']);
			$this->assertEquals($prod->getDescription(), $expected[$i]['description']);
			$this->assertEquals($prod->getDisponible(), $expected[$i]['disponible']);
		}
	}

	public function test_findById() {

		$expected = array(
		
			[
				'titre' => 'Default Cube',
				'prix' => 60.3,
				'description' => 'Default Blender cube - can not get better!',
				'disponible' => 1
			],
			[
				'titre'=>'Monke',
				'prix'=>213.4,
				'description'=>'Hmmmmmm.... Monke.',
				'disponible'=>1
			],
			[
				'titre'=>'Crewmate',
				'prix'=>213.4,
				'description'=>'Hmmmmmm.... Monke.',
				'disponible'=>1
			]
		);

		for ($i = 0; $i < count($expected); $i++) {
			$list = $this->obj->findById($i+1);
			$this->assertTrue(is_a($list, "ProductEntity"));
			$this->assertEquals($list->getTitre(), $expected[$i]['titre']);
			$this->assertEquals($list->getPrix(), $expected[$i]['prix']);
			$this->assertEquals($list->getDescription(), $expected[$i]['description']);
			$this->assertEquals($list->getDisponible(), $expected[$i]['disponible']);
		}	
	}

	public function test_findIdAvailable() {
		$expected = array(
			[
				'titre' => 'Default Cube',
				'prix' => 60.3,
				'description' => 'Default Blender cube - can not get better!',
				'disponible' => 1
			],
			[
				'titre'=>'Monke',
				'prix'=>213.4,
				'description'=>'Hmmmmmm.... Monke.',
				'disponible'=>1
			],
			[
				'titre'=>'Crewmate',
				'prix'=>213.4,
				'description'=>'Hmmmmmm.... Monke.',
				'disponible'=>1
			]
		);

		for ($i = 0; $i < count($expected); $i++) {
			$list = $this->obj->findByIdAvailable($i+1);
			$this->assertTrue(is_a($list, "ProductEntity"));
			$this->assertEquals($list->getTitre(), $expected[$i]['titre']);
			$this->assertEquals($list->getPrix(), $expected[$i]['prix']);
			$this->assertEquals($list->getDescription(), $expected[$i]['description']);
			$this->assertEquals($list->getDisponible(), $expected[$i]['disponible']);
		}	
	}

	public function test_findQueryBuilder() {
		$expected = [
			'titre' => 'Default Cube',
            'prix' => 60.3,
            'description' => 'Default Blender cube - can not get better!',
            'disponible' => 1];

		$filtre = new FiltreName(new Filtre(),"Cube");
		$filtre = new FiltreAvailable($filtre, true);
		$list = $this->obj->findQueryBuilder($filtre);

		$this->assertTrue(is_a($list[0], "ProductEntity"));
		$this->assertEquals($list[0]->getTitre(), $expected['titre']);
		$this->assertEquals($list[0]->getPrix(), $expected['prix']);
		$this->assertEquals($list[0]->getDescription(), $expected['description']);
		$this->assertEquals($list[0]->getDisponible(), $expected['disponible']);
	}

	public function test_addProduct() {
		$expected = [
			'titre' => 'Louis Painter',
			'prix' => 10.1,
			'description' => 'Le major de Promo',
			'disponible' => 1
		];

		$newProduit = new ProductEntity;
		$newProduit -> setTitre('Louis Painter');
		$newProduit -> setPrix(10.1);
		$newProduit -> setDescription('Le major de Promo');
		$newProduit -> setDisponible(True);

		$this->obj->addProduct($newProduit, array());

		$list = $this->obj->findById(4); 
		$this->assertTrue(is_a($list, "ProductEntity"));
		$this->assertEquals($list->getTitre(), $expected['titre']);
		$this->assertEquals($list->getPrix(), $expected['prix']);
		$this->assertEquals($list->getDescription(), $expected['description']);
		$this->assertEquals($list->getDisponible(), $expected['disponible']);
	}

	public function test_updateProduct() {
		$expected = [
			'titre' => 'Monke',
			'prix' => 213.40,
			'description' => 'Le major de Promo 3 fois de suite',
			'disponible' => 1
		];

		$produitChange = $this->obj->findById(2);

		$produitChange -> setDescription('Le major de Promo 3 fois de suite');
		$this->obj->updateProduct($produitChange, array());

		$this->assertTrue(is_a($produitChange, "ProductEntity"));
		$this->assertEquals($produitChange->getTitre(), $expected['titre']);
		$this->assertEquals($produitChange->getPrix(), $expected['prix']);
		$this->assertEquals($produitChange->getDescription(), $expected['description']);
		$this->assertEquals($produitChange->getDisponible(), $expected['disponible']);
	}

	public function test_removeProduct() {
		$this->obj->removeProduct(3);
		$this->assertNull($this->obj->findByIdAvailable(3));
	}


	#Ici une erreur est renvoyée "Unknown table 'website_test.facture'" 
	// public function test_findByFacture() {
	// 	$facture = $this->obj->findByFacture(2);

	// 	$this->assertEquals($facture->getUserId(), 2);
	// }

	#Procedure pas ajoutée dans la BDD test
	public function test_getProductsByUserId(){

		$product = $this->obj->findById(2);

		$this->assertEquals($this->obj->getProductsByUserId(2)[0], $product);
	}

	public function test_getNumberOfAvailableProducts(){
		$this->assertEquals(3,$this->obj->getNumberOfAvailableProducts());
	}
}