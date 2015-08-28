<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    //Dependencies:
    // require_once "src/Store.php";
    require_once "src/Brand.php";

    //Point to test database:
    $server = 'mysql:host=localhost:3306;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            // Store::deleteAll();
            Brand::deleteAll();
        }

        //Test Brand save method:
        function testSave()
        {
            //Arrange
            $brand_name = "Super Kicks";
            $test_brand = new Brand($brand_name);

            //Act
            $test_brand->save();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        //Test Brand getAll method:
        function testGetAll()
        {
            //Arrange
            $brand_name = "Super Kicks";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $brand_name2 = "Cool Shoes";
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        //Test Brand deleteAll method:
        function testDeleteAll()
        {
            //Arrange
            $brand_name = "Super Kicks";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $brand_name2 = "Cool Shoes";
            $test_brand2 = new Brand($brand_name2);
            $test_brand->save();

            //Act
            Brand::deleteAll();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([], $result);

        }

        //Test Brand getId method:
        function testGetId()
        {
            //Arrange
            $brand_name = "Super Kicks";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }




























    }
