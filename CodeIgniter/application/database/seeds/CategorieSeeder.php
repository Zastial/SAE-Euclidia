<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class CategorieSeeder extends Seeder {

	private $table = 'categorie';

	public function run()
	{
		$this->db->empty_table($this->table);
		$this->db->query('ALTER TABLE categorie AUTO_INCREMENT = 1;');

		$data = [
			'libelle' => 'meuble',

		];
		$this->db->insert($this->table, $data);


		$data = [
			'libelle' => 'high-tech',

		];
		$this->db->insert($this->table, $data);


		$data = [
			'libelle' => 'avion',

		];
		$this->db->insert($this->table, $data);
		
	}
}
?>  