<?php

//CI_TestCase
class Home_test extends CIPHPUnitTestCase 
{

    public function testIndexLoadsCorrectView() {

        $output = $this->request('POST', 'welcome/index');
        $this->assertStringContainsString(
            '<h1>Découvrez nos nouveaux modèles</h1>', $output
        );
    }
}

?>  