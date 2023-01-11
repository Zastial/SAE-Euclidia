<?php

class Contact_test extends CIPHPUnitTestCase 
{

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
		$CI =& get_instance();
		$this->CI = $CI->load->database('tests', TRUE);
	}

    public function testIndex() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=> 'alexcarol@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'contact/index');
        $this->assertResponseCode(200);
    }

}

?>  