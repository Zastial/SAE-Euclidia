<?php

class Admin_test extends CIPHPUnitTestCase 
{

    public function testIndex() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/index');
        $this->assertResponseCode(200);
    }

    public function testUsers() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/users');
        $this->assertResponseCode(200);
    }

    public function testCategories() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/categories');
        $this->assertResponseCode(200);
    }

    public function testProducts() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/products');
        $this->assertResponseCode(200);
    }

    public function testModifUser() {
        
        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email' => 'alex@mail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/modifUser/38');
        $this->assertResponseCode(200);
    }

    public function testAddProduct() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email' => 'alex@mail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/addProduct');
        $this->assertResponseCode(200);
    }

    public function testModifProduct() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email' => 'alex@mail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/modifProduct/1');
        $this->assertResponseCode(200);
    }

    public function testToggleVisibility() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email' => 'alex@mail.com', 'status' => 'Administrateur');

        $this->request('POST', 'admin/toggleVisibility/2');
        
        $output = $this->request('POST', 'admin/products');

        try {
            $this->assertStringContainsString(
                '<a href="http://172.26.82.48/Admin/toggleVisibility/2" class="item-center visible">', $output
            );
    
            $this->request('POST', 'admin/toggleVisibility/2');
        } catch (Exception $e) {
            $this->request('POST', 'admin/toggleVisibility/2');
        }
    }

    public function testAddCategorie() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email' => 'alex@mail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/addCategorie');
        $this->assertResponseCode(200);
    }

    public function testModifCategorie() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email' => 'alex@mail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/modifCategorie/1');
        $this->assertResponseCode(200);
    }
}

?>  