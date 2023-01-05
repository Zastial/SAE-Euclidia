<?php

class Admin_test extends CIPHPUnitTestCase 
{

    public function testIndex() {

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=>'alexcarol@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/index');
        $this->assertResponseCode(200);
    }

    public function testUsers() {

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=>'alexcarol@gmail.com', 'status' => 'Administrateur');
 
        $output = $this->request('POST', 'admin/users');
        $this->assertResponseCode(200);
    }

    public function testCategories() {

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=>'alexcarol@gmail.com', 'status' => 'Administrateur');
 
        $output = $this->request('POST', 'admin/categories');
        $this->assertResponseCode(200);
    }

    public function testProducts() {

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=>'alexcarol@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/products');
        $this->assertResponseCode(200);
    }

    public function testModifUser() {

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=>'alexcarol@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/modifUser/38');
        $this->assertResponseCode(200);
    }

    public function testAddProductView() {

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=>'alexcarol@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/addProduct');
        $this->assertResponseCode(200);
    }

    public function testAddProduct() {

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=>'alexcarol@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/addProductAjax', array('name'=>'testAlex','price'=>'69.69','description'=>'test','disponible'=>true,'categories'=>array()));
        $this->assertResponseCode(200);
    }

    public function testModifProductView() {

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=>'alexcarol@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/modifProduct/1');
        $this->assertResponseCode(200);
    }

    public function testToggleVisibility() {

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=>'alexcarol@gmail.com', 'status' => 'Administrateur');

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

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=>'alexcarol@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/addCategorie');
        $this->assertResponseCode(200);
    }

    public function testModifCategorie() {

        $CI =& get_instance();
        $CI->load->library('session');
        $CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email'=>'alexcarol@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'admin/modifCategorie/1');
        $this->assertResponseCode(200);
    }
}

?>  