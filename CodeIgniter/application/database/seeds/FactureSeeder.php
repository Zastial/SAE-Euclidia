<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class FactureSeeder extends Seeder {

	private $table = 'facture';

	public function run()
	{
		$this->db->empty_table($this->table);
        $this->db->query('ALTER TABLE facture AUTO_INCREMENT = 1;');

		$data = [
            'date_facture' => '12/12/21',
            'total' => '60.30',
            'id_utilisateur' => '1',
            'adresse' => 'rue du test',
            'numero_rue' => '1',
            'pays' => 'FranceTest',
            'ville' => 'NantesTest',
            'code_postal' => '44300',
            'paiement' => 'paypal',
		];
		$this->db->insert($this->table, $data);

        $data = [
            'date_facture' => '12/12/21',
            'total' => '213.40',
            'id_utilisateur' => '2',
            'adresse' => 'rue du test',
            'numero_rue' => '1',
            'pays' => 'FranceTest',
            'ville' => 'NantesTest',
            'code_postal' => '44300',
            'paiement' => 'paypal',
		];
		$this->db->insert($this->table, $data);

        $data = [
            'date_facture' => '12/12/21',
            'total' => '213.40',
            'id_utilisateur' => '3',
            'adresse' => 'rue du test',
            'numero_rue' => '1',
            'pays' => 'FranceTest',
            'ville' => 'NantesTest',
            'code_postal' => '44300',
            'paiement' => 'paypal',
		];
		$this->db->insert($this->table, $data);
	}
}
?>  