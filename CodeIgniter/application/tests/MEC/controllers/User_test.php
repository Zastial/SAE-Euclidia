<?php

class User_test extends CIPHPUnitTestCase 
{
    // public function testRegister() {
    //     $output = $this->request('POST', 'User/register', array('nom'=>'carol','prenom'=>'alexandre','email'=>'alexcarolo@gmail.com','password'=>'Testest09!','confirm-password'=>'Testest09!'));
    //     $this->assertResponseCode(302);
    // }

    public function testLogin() {
        $output = $this->request('POST', 'User/login', array('email'=>'louis.nolan.painter@gmail.com','password'=>'$2y$10$ozdePhwZoSc5VdEGlJk4YOMdUpZm0P636Mn3svUjOlSpLY4PwF42O'));
        $this->assertResponseCode(302); //vérifie que l'on est bien redirigé après la connexion
    }

    public function testModifyAddress() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Painteri','prenom' => 'Louisa', 'email'=>'louis.nolan.painter@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'User/modifyAddress');
        $this->assertResponseCode(200);
    }

    public function testModify() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Painteri','prenom' => 'Louisa', 'email'=>'louis.nolan.painter@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'User/modify', array('nom' => 'Painteri','prenom' => 'Louisa', 'email'=>'louis.nolan.painter@gmail.com','password'=>'$2y$10$ozdePhwZoSc5VdEGlJk4YOMdUpZm0P636Mn3svUjOlSpLY4PwF42O'));
        $this->assertResponseCode(200);
    }

    public function testAccountConnected() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Painteri','prenom' => 'Louisa', 'email'=>'louis.nolan.painter@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'User/account');
        $this->assertResponseCode(200);
    }

    public function testAccountNotConnected() {

        $output = $this->request('POST', 'User/account');
        $this->assertResponseCode(302);
    }

    public function testModifyAdress() {

        $this->resetInstance();
        $this->CI->load->library('session');
        $this->CI->session->user = array('nom' => 'Painteri','prenom' => 'Louisa', 'email'=>'louis.nolan.painter@gmail.com', 'status' => 'Administrateur');

        $output = $this->request('POST', 'User/modifyAddress');
        $this->assertResponseCode(200);

        $output = $this->request('POST', 'User/modifyAddress',array('numerorue'=>'24','adresse'=>'ici','ville'=>'Toulouse','codepostal'=>'31000','pays'=>'Quebec'));
        $this->assertResponseCode(302);
    }

}

?>  