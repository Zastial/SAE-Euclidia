<?php

class Product_test extends CIPHPUnitTestCase 
{

    public function testFindCategorie() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'status' => 'Administrateur');

        $output = $this->request('GET', 'product/find?rechercher=Alexandre');
        $this->assertResponseCode(200);
    }

    public function testFindRechercher() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'status' => 'Administrateur');

        $output = $this->request('GET', 'product/find?rechercher=Alexandre');
        $this->assertResponseCode(200);
    }

    public function testDisplay() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email' => 'alex@email.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'product/display/2');
        $this->assertResponseCode(200);
    }
  
}

?>  