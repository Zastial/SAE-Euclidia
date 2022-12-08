<?php

class ProductModel_test extends UnitTestCase {

    public static function setUpBeforeClass() : void
	{
		parent::setUpBeforeClass();

		$CI =& get_instance();
		$CI->load->library('Seeder');
		$CI->seeder->call('ProductSeeder');
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
}