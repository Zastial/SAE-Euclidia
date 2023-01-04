<?php

class User_test extends CIPHPUnitTestCase 
{

    public function testRegister() {

        $this->resetInstance();
        $this->CI->load->library('session');

        
        $output = $this->request('POST', 'User/register',array('nom'=>'carol','prenom'=>'alexandre','email'=>'alexcarol@gmail.com','password'=>'Testest09!'));
        $this->assertResponseCode(200);
    }

    public function testLogin() {

        $this->resetInstance();
        $this->CI->load->library('session');

        $output = $this->request('POST', 'User/login');
        $this->assertResponseCode(200);

        $output = $this->request('POST', 'User/login', array('email'=>'sasandre10@gmail.com','password'=>'09022003Aa!'));
        $this->assertResponseCode(302); //vérifie que l'on est bien redirigé après la connexion
    }

    public function testModifyPersonnalAddress() {

        $this->resetInstance();
        $this->CI->load->library('session');

        $this->request('POST', 'User/login', array('email'=>'sasandre10@gmail.com','password'=>'09022003Aa!'));

        $output = $this->request('POST', 'User/modifyPersonnalAddress');
        $this->assertResponseCode(200);
    }

    public function testModify() {

        $this->resetInstance();
        $this->CI->load->library('session');

        $this->request('POST', 'User/login', array('email'=>'sasandre10@gmail.com','password'=>'09022003Aa!'));

        $output = $this->request('POST', 'User/modify', array('nom'=>'carol','prenom'=>'alexandre','email'=>'alexcarol@gmail.com'));
        $this->assertResponseCode(200);
    }

    public function testAccountConnected() {

        $this->resetInstance();
        $this->CI->load->library('session');

        $this->request('POST', 'User/login', array('email'=>'sasandre10@gmail.com','password'=>'09022003Aa!'));

        $output = $this->request('POST', 'User/account');
        $this->assertResponseCode(200);
    }

    public function testAccountNotConnected() {

        $this->resetInstance();
        $this->CI->load->library('session');

        $output = $this->request('POST', 'User/account');
        $this->assertResponseCode(302);
    }

    public function testModifyAdress() {

        $this->resetInstance();
        $this->CI->load->library('session');

        $this->request('POST', 'User/login', array('email'=>'sasandre10@gmail.com','password'=>'09022003Aa!'));

        $output = $this->request('POST', 'User/modifyAddress');
        $this->assertResponseCode(200);

        $output = $this->request('POST', 'User/modifyAddress',array('numerorue'=>'24','adresse'=>'ici','ville'=>'Toulouse','codepostal'=>'31000','pays'=>'Quebec'));
        $this->assertResponseCode(302);
    }

}

?>  