<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    //Dependencies:
    require_once "src/Store.php";
    require_once "src/Brand.php";

    //Point to test database:
    $server = 'mysql:host=localhost:3306;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
            $GLOBALS['DB']->exec("DELETE FROM brands_stores;");
        }

        //Test Store save method:
        function testSave()
        {
            //Arrange
            $store_name = "Shoes Galore";
            $test_store = new Store($store_name);

            //Act
            $test_store->save();
            $result = Store::getAll();

            //Assert
            $this->assertEquals($test_store, $result[0]);
        }

        //Test Store getAll method:
        function testGetAll()
        {
            //Arrange
            $store_name = "Shoes Galore";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Save Our Soles";
            $test_store2 = new Store($store_name);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        //Test Store deleteAll method:
        function testDeleteAll()
        {
            //Arrange
            $store_name = "Shoes Galore";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Save Our Soles";
            $test_store2 = new Store($store_name);
            $test_store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        //Test Store getId method:
        function testGetId()
        {
            //Arrange
            $store_name = "Shoes Galore";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        //Test Store update method:
        function testUpdate()
        {
            //Arrange
            $store_name = "Shoes Galore";
            $test_store = new Store($store_name);
            $test_store->save();

            $new_store_name = "Save Our Soles";

            //Act
            $test_store->update($new_store_name);
            $result = $test_store->getStoreName();

            //Assert
            $this->assertEquals("Save Our Soles", $result);
        }

        //Test Store delete method:
        function testDelete()
        {
            //Arrange
            $store_name = "Shoes Galore";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Save Our Soles";
            $test_store2 = new Store($store_name);
            $test_store2->save();

            //Act
            $test_store->delete();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store2], $result);
        }

        //Test Store addBrand method:
        function testAddBrand()
        {
            //Act
            $store_name = "Shoes Galore";
            $test_store = new Store($store_name);
            $test_store->save();

            $brand_name = "Super Kicks";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            //Act
            $test_store->addBrand($test_brand);
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand], $result);
        }

        //Test Store getBrands method:
        function testgetBrands()
        {
            //Arrange
            $store_name = "Shoes Galore";
            $test_store = new Store($store_name);
            $test_store->save();

            $brand_name = "Super Kicks";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $brand_name2 = "Cool Shoes";
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            //Act
            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        //Test Store find method:
        function testFind()
        {
            //Arrange
            $store_name = "Shoes Galore";
            $test_store = new Store($store_name);
            $test_store->save();

            $store_name2 = "Save Our Soles";
            $test_store2 = new Store($store_name);
            $test_store2->save();

            //Act
            $id = $test_store->getId();
            $result = Store::find($id);

            //Assert
            $this->assertEquals($test_store, $result);
        }


















    }

?>
