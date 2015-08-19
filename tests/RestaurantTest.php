<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=best_restaurants_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_getId()
        {
            //cuisine
            $name = "Japanese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            //restaurant
            $name = "Good Fortune";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant->save();

            $result = $test_restaurant->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCuisineId()
        {
            //cuisine
            $name = "Japanese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            //restaurant
            $name = "Good Fortune";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant->save();

            $result = $test_restaurant->getCuisineId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //cuisine
            $name = "Japanese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            //restaurant
            $name = "Good Fortune";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);

            $test_restaurant->save();

            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_getAll()
        {
            //cuisine
            $name = "Japanese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            //restaurant1
            $name = "Good Fortune";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant->save();

            //restaurant2
            $name2 = "Good Luck";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant2->save();

            $result = Restaurant::getAll();

            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function test_deleteAll()
        {
            //cuisine
            $name = "Japanese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            //restaurant1
            $name = "Good Fortune";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant->save();

            //restaurant2
            $name2 = "Good Luck";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant2->save();

            Restaurant::deleteAll();

            $result = Restaurant::getAll();
            $this->AssertEquals([], $result);
        }

        function test_find()
        {
            //cuisine
            $name = "Japanese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            //restaurant1
            $name = "Good Fortune";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant->save();

            //restaurant2
            $name2 = "Good Luck";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant2->save();

            $id = $test_Restaurant->getId();
            $result = Restaurant::find($id);

            $this->assertEquals($test_Restaurant, $result);
        }
    }
?>
