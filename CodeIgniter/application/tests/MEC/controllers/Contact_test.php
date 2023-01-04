<?php

class Contact_test extends CIPHPUnitTestCase 
{

    public function testIndex() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'status' => 'Administrateur');

        $output = $this->request('POST', 'contact/index');
        $this->assertResponseCode(200);
    }

}

?>  