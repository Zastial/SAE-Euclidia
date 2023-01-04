<?php

class Error404_test extends CIPHPUnitTestCase 
{

    public function testIndex() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'status' => 'Administrateur');

        $output = $this->request('POST', 'Error404/index');
        $this->assertResponseCode(404);
    }

}

?>  