<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class ProductSeeder extends Seeder {

	private $table = 'produit';

	public function run()
	{
		$this->db->empty_table($this->table);
		// $this->db->query('ALTER TABLE ? AUTO_INCREMENT = 1;', array($this->table));
		$this->db->query('ALTER TABLE produit AUTO_INCREMENT = 1;');

		$data = [
			'titre' => 'Default Cube',
            'prix' => 60.3,
            'description' => 'Default Blender cube - can not get better!',
            'disponible' => 1
		];
		$this->db->insert($this->table, $data);

		$data = [
			'titre'=>'Monke',
			'prix'=>213.4,
			'description'=>'Hmmmmmm.... Monke.',
			'disponible'=>1
		];
		$this->db->insert($this->table, $data);

		$data = [
			'titre'=>'Crewmate',
			'prix'=>213.4,
			'description'=>'Hmmmmmm.... Monke.',
			'disponible'=>1
		];
		$this->db->insert($this->table, $data);
		
	}

}
?>  