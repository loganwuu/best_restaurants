<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=best_restaurants_tests';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_getName()
        {
            $name = "Japanese";
            $test_cuisine = new Cuisine($name);

            $result = $test_cuisine->getName();

            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            $name = "Japanese";
            $id = 1;
            $test_cuisine = new Cuisine($name, $id);

            $result = $test_cuisine->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            $name = "Japanese";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();

            $result = Cuisine::getAll();

            $this->assertEquals($test_cuisine, $result[0]);
        }

        function test_getAll()
        {
            $name = "Japanese";
            $name2 = "hyrulian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            $result = Cuisine::getAll();

            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function test_deleteAll()
        {
            $name = "Japanese";
            $name2 = "hyrulian";
            $test_cuisine = new Cuisine($name);
            $test_cuisine->save();
            $test_cuisine2 = new Cuisine($name2);
            $test_cuisine2->save();

            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            $this->assertEquals([], $result);
        }

        function testGetRestaurants()
        {
            $name = "Japanese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();

            //restaurant1
            $name = "Good Fortune";
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant->save();

            //restaurant2
            $name2 = "Good Luck";
            $test_restaurant2 = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant2->save();

            $result = $test_cuisine->getRestaurants();

            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }
    }
?>
