<?php

class Product_test extends CIPHPUnitTestCase 
{

    public function testFindCategorie() {

        $output = $this->request('GET', 'product/find?categorie[]=10');
        $this->assertResponseCode(200);
    }

    public function testFindRechercher() {            

        $output = $this->request('GET', 'product/find?rechercher=Alexandre');
        $this->assertResponseCode(200);
    }

    public function testFindTri() {            

        $output = $this->request('GET', 'product/find?tri=prix-asc');
        $this->assertResponseCode(200);
    }

    public function testFindPage() {            

        $output = $this->request('GET', 'product/find?page=2');
        $this->assertResponseCode(200);
    }

    public function testPriceMin() {            

        $output = $this->request('GET', 'product/find?price-min=500');
        $this->assertResponseCode(200);
    }

    public function testPriceMax() {            

        $output = $this->request('GET', 'product/find?price-max=50');
        $this->assertResponseCode(200);
    }

    public function testDisplay() {

        $output = $this->request('POST', 'product/display/2');
        $this->assertResponseCode(200);
    }

    public function testDisplay2() {

        $output = $this->request('POST', 'product/display/3');
        $this->assertResponseCode(200);
    }

    public function testDisplayError() {

        $output = $this->request('POST', 'product/display/542');
        $this->assertResponseCode(302); //redirigé vers 'product/find' car le produit n'a pas été trouvé
    }
  
}

?>  