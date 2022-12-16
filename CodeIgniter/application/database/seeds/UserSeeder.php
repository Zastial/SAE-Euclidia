<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class UserSeeder extends Seeder {

	private $table = 'utilisateur';

	public function run()
	{
		$this->db->empty_table('achat');
		$this->db->empty_table('facture');
		$this->db->empty_table($this->table);
		$this->db->query('ALTER TABLE utilisateur AUTO_INCREMENT = 1;');

		$data = [
			'prenom' => 'Louis',
            'nom' => 'Painter',
            'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
            'email' => 'louis.nolan.painter@gmail.com',
            'status' => 'Administrateur'

		];
		$this->db->insert($this->table, $data);

		$data = [
			'prenom' => 'Martin',
            'nom' => 'Schreiber',
            'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
            'email' => 'email@gmail.com',
            'status' => 'Administrateur'
		];
		$this->db->insert($this->table, $data);

		$data = [
			'prenom' => 'Alexandre',
            'nom' => 'Carrrrrol',
            'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
            'email' => 'email2@gmail.com',
            'status' => 'Utilisateur'
		];
		$this->db->insert($this->table, $data);
		
	}

}
?>  