<?php

//CI_TestCase
class Admin_test extends CIPHPUnitTestCase 
{

    public function testIndex() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'status' => 'Responsable');

        $output = $this->request('POST', 'admin/index');
        $this->assertStringContainsString(
            '<h1>Tables</h1>', $output
        );
    }

        public function testUsers() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'status' => 'Responsable');

        $output = $this->request('POST', 'admin/users');
        $this->assertStringContainsString(
            '<div class="grid head"></div>', $output
        );
    }  
}

?>  