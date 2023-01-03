<?php
class CategorieEntity_test extends UnitTestCase {

    public function testSetLibelle()
    {
        $categorie = new CategorieEntity();
        $categorie->setLibelle('Electronics');
        $this->assertEquals('Electronics', $categorie->getLibelle());
    }

}
?>