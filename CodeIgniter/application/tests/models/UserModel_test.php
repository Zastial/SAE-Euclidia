<?php

class UserModel_test extends UnitTestCase {

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
		$this->obj = $this->newModel('UserModel');
		$CI =& get_instance();
		$this->obj->db = $CI->load->database('tests', TRUE);
	}

    public function test_findAll() 
    {
		$list = $this->obj->findAll();
		$expected = array(
			[
                'prenom' => 'Louis',
                'nom' => 'Painter',
                'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
                'email' => 'louis.nolan.painter@gmail.com',
                'status' => 'Administrateur'
			],
			[
                'prenom' => 'Martin',
                'nom' => 'Schreiber',
                'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
                'email' => 'email@gmail.com',
                'status' => 'Administrateur'
			],
			[
                'prenom' => 'Alexandre',
                'nom' => 'Carrrrrol',
                'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
                'email' => 'email2@gmail.com',
                'status' => 'Utilisateur'
			]
		);

		$this->assertEquals(count($list), count($expected));

		for ($i = 0; $i < count($list); $i++) {
			$prod = $list[$i];
			$this->assertTrue(is_a($prod, "UserEntity"));
            $this->assertEquals($prod->getNom(), $expected[$i]['nom']);
            $this->assertEquals($prod->getPrenom(), $expected[$i]['prenom']);
            $this->assertEquals($prod->getEmail(), $expected[$i]['email']);
            $this->assertEquals($prod->getStatus(), $expected[$i]['status']);
		}
    }

	public function test_findById() {

		$expected = array(
			[
                'prenom' => 'Louis',
                'nom' => 'Painter',
                'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
                'email' => 'louis.nolan.painter@gmail.com',
                'status' => 'Administrateur'
			],
			[
                'prenom' => 'Martin',
                'nom' => 'Schreiber',
                'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
                'email' => 'email@gmail.com',
                'status' => 'Administrateur'
			],
			[
                'prenom' => 'Alexandre',
                'nom' => 'Carrrrrol',
                'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
                'email' => 'email2@gmail.com',
                'status' => 'Utilisateur'
			]
		);
		for ($i = 0; $i < count($expected); $i++) {
			$list = $this->obj->findById($i+1);
			$this->assertTrue(is_a($list, "UserEntity"));
            $this->assertEquals($list->getNom(), $expected[$i]['nom']);
            $this->assertEquals($list->getPrenom(), $expected[$i]['prenom']);
            $this->assertEquals($list->getPassword(), $expected[$i]['password']);
            $this->assertEquals($list->getEmail(), $expected[$i]['email']);
            $this->assertEquals($list->getStatus(), $expected[$i]['status']);
		}	
	}

	public function test_findByEmail() {
		$expected = array(
			[
                'prenom' => 'Louis',
                'nom' => 'Painter',
                'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
                'email' => 'louis.nolan.painter@gmail.com',
                'status' => 'Administrateur'
			],
			[
                'prenom' => 'Martin',
                'nom' => 'Schreiber',
                'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
                'email' => 'email@gmail.com',
                'status' => 'Administrateur'
			],
			[
                'prenom' => 'Alexandre',
                'nom' => 'Carrrrrol',
                'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
                'email' => 'email2@gmail.com',
                'status' => 'Utilisateur'
			]
		);

		for ($i = 0; $i < count($expected); $i++) {
			$list = $this->obj->findByEmail($expected[$i]['email']);
			$this->assertTrue(is_a($list, "UserEntity"));
            $this->assertEquals($list->getNom(), $expected[$i]['nom']);
            $this->assertEquals($list->getPrenom(), $expected[$i]['prenom']);
            $this->assertEquals($list->getPassword(), $expected[$i]['password']);
            $this->assertEquals($list->getEmail(), $expected[$i]['email']);
            $this->assertEquals($list->getStatus(), $expected[$i]['status']);
		}	
	}

	public function test_addUser() {
		$expected = ['prenom' => 'Leo',
            'nom' => 'SIU',
            'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
            'email' => 'siuleo@gmail.com',
            'status' => 'Utilisateur'];

		$newUser = new UserUtilisateur;
		$newUser -> setNom('SIU');
		$newUser -> setPrenom('Leo');
		$newUser -> setPassword('2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6');
		$newUser -> setEmail("siuleo@gmail.com");

		$this->obj->addUser($newUser);

		$list = $this->obj->findById(4); 
		$this->assertTrue(is_a($list, "UserEntity"));
		$this->assertEquals($list->getNom(), $expected['nom']);
		$this->assertEquals($list->getPrenom(), $expected['prenom']);
		$this->assertEquals($list->getPassword(), $expected['password']);
		$this->assertEquals($list->getEmail(), $expected['email']);
        $this->assertEquals($list->getStatus(), $expected['status']);
	}

	public function test_updateUser() {
		$expected = ['prenom' => 'Martin',
            'nom' => 'Schreiber',
            'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
            'email' => 'schreibermartin@gmail.com',
            'status' => 'Administrateur'];


		$userChange = $this->obj->findById(2);

		$userChange -> setEmail('schreibermartin@gmail.com');
		$this->obj->updateUser($userChange);

        $userChange = $this->obj->findById(2);
        $this->assertTrue(is_a($userChange, "UserEntity"));
		$this->assertEquals($userChange->getNom(), $expected['nom']);
		$this->assertEquals($userChange->getPrenom(), $expected['prenom']);
		$this->assertEquals($userChange->getPassword(), $expected['password']);
		$this->assertEquals($userChange->getEmail(), $expected['email']);
        $this->assertEquals($userChange->getStatus(), $expected['status']);
	}

    public function test_activeUser() {
        $user = $this->obj->findById(2);
        $user -> setEtat("inactive");

        $user = $this->obj->activeUser($user);
        $user = $this->obj->findById(2);

        $this->assertEquals($user->getEtat(), 'inactive');

    }    

    public function test_isActive() {
        $user = $this->obj->findById(1);
        $this->assertTrue($this->obj->isActive($user));

        $user = $this->obj->findById(2);
        $this->assertFalse($this->obj->isActive($user));
    }


}