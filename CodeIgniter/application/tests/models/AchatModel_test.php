<?php

class AchatModel_test extends UnitTestCase {

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
		$this->obj = $this->newModel('AchatModel');
		$CI =& get_instance();
		$this->obj->db = $CI->load->database('tests', TRUE);
	}

    public function test_findAll() 
    {
		$list = $this->obj->findAll();
		$expected = array(
			[
                'id_produit' => 1,
                'id_facture' => 1,
                'prix' => 60.30
			],
			[
				'id_produit' => 2,
                'id_facture' => 2,
                'prix' => 213.40
			],
			[
				'id_produit' => 3,
                'id_facture' => 3,
                'prix' => 213.40
			]
		);

		$this->assertEquals(count($list), count($expected));

		for ($i = 0; $i < count($list); $i++) {
			$prod = $list[$i];
			$this->assertTrue(is_a($prod, "AchatEntity"));
			$this->assertEquals($prod->getIdProduit(), $expected[$i]['id_produit']);
			$this->assertEquals($prod->getIdFacture(), $expected[$i]['id_facture']);
			$this->assertEquals($prod->getPrix(), $expected[$i]['prix']);
		}
    }

	public function test_findById() {

		$expected = array(
			[
                'id_produit' => 1,
                'id_facture' => 1,
                'prix' => 60.30
			],
			[
				'id_produit' => 2,
                'id_facture' => 2,
                'prix' => 213.40
			],
			[
				'id_produit' => 3,
                'id_facture' => 3,
                'prix' => 213.40
			]
		);

		for ($i = 0; $i < count($expected); $i++) {
			$list = $this->obj->findById($i+1);
			$this->assertTrue(is_a($list[0], "AchatEntity"));
			$this->assertEquals($list[0]->getIdProduit(), $expected[$i]['id_produit']);
			$this->assertEquals($list[0]->getIdFacture(), $expected[$i]['id_facture']);
			$this->assertEquals($list[0]->getPrix(), $expected[$i]['prix']);
		}	
	}

    public function test_boughtFromUser() {

        $emails = [ 
            "louis.nolan.painter@gmail.com",
            "email@gmail.com",
            "email2@gmail.com"
        ];

        for ($i = 0; $i < count($emails); $i++) {
            $bought = $this->obj->boughtFromUser($i+1, $emails[$i]);
            $this->assertTrue($bought);
        }        
    } 

	public function test_addAchat() {
		$expected = [   
            'id_produit' => 4,
            'id_facture' => 4,
            'prix' => 426.8
        ];

		$newAchat = new AchatEntity;
		$newAchat -> setIdProduit(4);
		$newAchat -> setIdFacture(4);
		$newAchat -> setprix(426.8);

		$ans = $this->obj->addAchat($newAchat);
		$this->assertTrue($ans);
	}

}