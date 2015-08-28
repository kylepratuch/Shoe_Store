<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    //Dependencies:
    require_once "src/Store.php";
    // require_once "src/Brand.php";

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
            // Brand::deleteAll();
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



















    }

?>
