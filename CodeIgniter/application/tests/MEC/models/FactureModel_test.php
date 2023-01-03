<?php

class FactureModel_test extends UnitTestCase {

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
		$this->obj = $this->newModel('FactureModel');
		$CI =& get_instance();
		$this->obj->db = $CI->load->database('tests', TRUE);
	}

    public function test_findByUser() {

		$expected = array(
			[
                'date_facture' => '2012-12-21 00:00:00',
                'total' => '213.40',
                'id_utilisateur' => '2',
                'adresse' => 'rue du test',
                'numero_rue' => '1',
                'pays' => 'FranceTest',
                'ville' => 'NantesTest',
                'code_postal' => '44300',
                'paiement' => 'paypal'
			]
		);

        $list = $this->obj->findByUser(2);
        for ($i=0;$i<count($list);$i++) {
            $this->assertEquals($list[$i]->getDate(), $expected[$i]['date_facture']);
            $this->assertEquals($list[$i]->getTotal(), $expected[$i]['total']);
            $this->assertEquals($list[$i]->getUserId(), $expected[$i]['id_utilisateur']);
            $this->assertEquals($list[$i]->getAdresse(), $expected[$i]['adresse']);
            $this->assertEquals($list[$i]->getNumeroRue(), $expected[$i]['numero_rue']);
            $this->assertEquals($list[$i]->getPays(), $expected[$i]['pays']);
            $this->assertEquals($list[$i]->getVille(), $expected[$i]['ville']);
            $this->assertEquals($list[$i]->getCodePostal(), $expected[$i]['code_postal']);
            $this->assertEquals($list[$i]->getPaiement(), $expected[$i]['paiement']);
        }
	}

	public function test_findById() {

		$expected =
			[
                'date_facture' => '2012-12-21 00:00:00',
                'total' => '60.30',
                'id_utilisateur' => '1',
                'adresse' => 'rue du test',
                'numero_rue' => '1',
                'pays' => 'FranceTest',
                'ville' => 'NantesTest',
                'code_postal' => '44300',
                'paiement' => 'paypal'
            ];

        $list = $this->obj->findById(1);
        $this->assertEquals($list->getDate(), $expected['date_facture']);
        $this->assertEquals($list->getTotal(), $expected['total']);
        $this->assertEquals($list->getUserId(), $expected['id_utilisateur']);   
        $this->assertEquals($list->getAdresse(), $expected['adresse']);
        $this->assertEquals($list->getNumeroRue(), $expected['numero_rue']);
        $this->assertEquals($list->getPays(), $expected['pays']);
        $this->assertEquals($list->getVille(), $expected['ville']);
        $this->assertEquals($list->getCodePostal(), $expected['code_postal']);
        $this->assertEquals($list->getPaiement(), $expected['paiement']);
	}

	public function test_addFacture() {

		$newFacture = new FactureEntity;
		$newFacture -> setDate('2012-12-24 00:00:00');
		$newFacture -> setTotal(230.80);
		$newFacture -> setUserId(3);
        $newFacture -> setAdresse('rue du test');
        $newFacture -> setNumeroRue(4);
        $newFacture -> setPays('FranceTest');
        $newFacture -> setVille('NantesTest');
        $newFacture -> setCodePostal(44300);
        $newFacture -> setPaiement('paypal');

		$ans = $this->obj->addFacture($newFacture);
		$this->assertTrue(is_a($ans, "FactureEntity"));
    }

}