<?php

class ShoppingCart_test extends CIPHPUnitTestCase 
{

    public function testIndex() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email' => 'alex@email.com', 'status' => 'Utilisateur');

        $output = $this->request('POST', 'ShoppingCart/index');
        $this->assertResponseCode(200);
    }

    public function testAddProduct() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email' => 'alex@email.com', 'status' => 'Utilisateur');

        $this->request('POST', 'ShoppingCart/addProduct/3');
        
        $output = $this->request('POST', 'ShoppingCart/index');
        $this->assertResponseCode(200);
    }

    public function testRemoveProduct() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Carol','prenom' => 'Alex', 'email' => 'alex@email.com', 'status' => 'Utilisateur');

        $this->request('POST', 'ShoppingCart/addProduct/3');
        
        $output = $this->request('POST', 'ShoppingCart/index');
        $this->assertResponseCode(200);

        $this->request('POST', 'ShoppingCart/removeProduct/3');

        $output = $this->request('POST', 'ShoppingCart/index');
        $this->assertResponseCode(200);
    }

    public function testOrderCommand() {

        $this->resetInstance();
        $this->CI->load->library('session');

        $this->CI->session->user = array('prenom' => 'Louis',
        'nom' => 'Painter',
        'password' => '2y$10$JMuuaDMCavASPKf9KBcD1eaMHJ0zkeD8eYs7HjecoD8QeUVRhKQq6',
        'email' => 'louis.nolan.painter@gmail.com',
        'status' => 'Utilisateur');

        $this->request('POST', 'ShoppingCart/addProduct/2');

        $output = $this->request('POST', 'ShoppingCart/orderCommand');
        $this->assertResponseCode(200);
    }

    public function testValidatePayment() {

        $this->resetInstance();
        $this->CI->load->library('session');

        $this->request('POST', 'User/login', array('email'=>'sasandre10@gmail.com','password'=>'09022003Aa!'));

        $this->request('POST', 'ShoppingCart/addProduct/2');

        $this->request('POST', 'ShoppingCart/orderCommand');

        $output = $this->request('POST', 'ShoppingCart/validatePayment',array('numerorue'=>'24','adresse'=>'ici','ville'=>'Toulouse','codepostal'=>'31000','pays'=>'Quebec'));
        $this->assertResponseCode(302);
    }

    public function testEmptyCart() {

        $this->resetInstance();
        $this->CI->load->library('session');

        $this->CI->session->user = array('prenom' => 'Louis',
        'nom' => 'Painter',
        'password' => '09022003Aa!',
        'email' => 'sasandre10@gmail.com',
        'status' => 'Utilisateur');

        $this->request('POST', 'ShoppingCart/addProduct/2');
        $this->assertTrue(count($this->CI->session->cart)==1);

        
        $output = $this->request('POST', 'ShoppingCart/emptyCart');
        $this->assertTrue(count($this->CI->session->cart)==0);
    }

    public function testGet_card_total() {

        $this->resetInstance();
        $this->CI->load->library('session');

        $this->CI->session->user = array('prenom' => 'Louis',
        'nom' => 'Painter',
        'password' => '09022003Aa!',
        'email' => 'sasandre10@gmail.com',
        'status' => 'Utilisateur');

        $this->request('POST', 'ShoppingCart/addProduct/2');
        $output = $this->request('POST', 'ShoppingCart/get_card_total');
        $this->assertTrue(count($this->CI->session->cart)==1);

        
        $this->request('POST', 'ShoppingCart/addProduct/3');
        $output = $this->request('POST', 'ShoppingCart/get_card_total');
        $this->assertTrue(count($this->CI->session->cart)==2);
    }
    
}

?>  