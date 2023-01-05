<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class AffectationSeeder extends Seeder {

	private $table = 'affectation';

	public function run()
	{
		$this->db->empty_table($this->table);

		$data = [
            'id_produit' => '3',
			'id_categorie' => '2',

		];
		$this->db->insert($this->table, $data);


		$data = [
            'id_produit' => '1',
			'id_categorie' => '1',
		];
		$this->db->insert($this->table, $data);


		$data = [
            'id_produit' => '2',
			'id_categorie' => '1',

		];
		$this->db->insert($this->table, $data);

        $data = [
            'id_produit' => '2',
			'id_categorie' => '2',

		];
		$this->db->insert($this->table, $data);
		
	}
}
?>  