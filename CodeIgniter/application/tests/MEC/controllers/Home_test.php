<?php

class Home_test extends CIPHPUnitTestCase 
{

    public function testIndex() {

        $output = $this->request('POST', 'home');
        $this->assertResponseCode(200);
    }
}

?>