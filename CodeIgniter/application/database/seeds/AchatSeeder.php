<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class AchatSeeder extends Seeder {

	private $table = 'achat';

	public function run()
	{
		$this->db->empty_table($this->table);

		$data = [
			'id_produit' => '1',
            'id_facture' => '1',
            'prix' => 60.30,
		];
		$this->db->insert($this->table, $data);

		$data = [
			'id_produit' => '2',
            'id_facture' => '2',
            'prix' => 213.40,
		];
		$this->db->insert($this->table, $data);

		$data = [
			'id_produit' => '3',
            'id_facture' => '3',
            'prix' => 213.40,
		];
		$this->db->insert($this->table, $data);
		
	}

}
?>  