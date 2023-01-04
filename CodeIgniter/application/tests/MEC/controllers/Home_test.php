<?php

class Home_test extends CIPHPUnitTestCase 
{

    public function testIndex() {

        $output = $this->request('POST', 'welcome/index');
        $this->assertResponseCode(200);
    }
}

?>