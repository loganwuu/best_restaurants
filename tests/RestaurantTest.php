<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";
    require_once "src/Review.php";

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
            Review::deleteAll();
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
            $description = "very tasty.";
            $address = "1111 SW 11th Ave";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $description, $address);
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
            $description = "very tasty.";
            $address = "1111 SW 11th Ave";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $description, $address);
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
            $description = "very tasty.";
            $address = "1111 SW 11th Ave";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $description, $address);

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
            $description = "very tasty.";
            $address = "1111 SW 11th Ave";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $description, $address);
            $test_restaurant->save();

            //restaurant2
            $name2 = "Good Luck";
            $description2 = "very yummy.";
            $address2 = "2222 SW 12th Ave";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id, $description2, $address2);
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
            $description = "very tasty.";
            $address = "1111 SW 11th Ave";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $description, $address);
            $test_restaurant->save();

            //restaurant2
            $name2 = "Good Luck";
            $description2 = "very yummy.";
            $address2 = "2222 SW 12th Ave";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id, $description2, $address2);
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
            $description = "very tasty.";
            $address = "1111 SW 11th Ave";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id, $description, $address);
            $test_restaurant->save();

            //restaurant2
            $name2 = "Good Luck";
            $description2 = "very yummy.";
            $address2 = "2222 SW 12th Ave";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id, $description2, $address2);
            $test_restaurant2->save();

            $id = $test_restaurant->getId();
            $result = Restaurant::find($id);

            $this->assertEquals($test_restaurant, $result);
        }

        function test_GetReviews()
        {
            //cuisine
            $name = "Japanese";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();

            //restaurant1
            $name = "Good Fortune";
            $description = "very tasty.";
            $address = "1111 SW 11th Ave";
            $test_restaurant = new Restaurant($name, $id, $test_cuisine_id, $description, $address);
            $test_restaurant->save();

            //review1
            $username = "Ben";
            $date = '0000-00-00';
            $rating = 5;
            $comment = "good one.";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($username, $date, $rating, $comment, $restaurant_id, $id);
            $test_review->save();

            //review2
            $username2 = "Jen";
            $date2 = '1111-00-00';
            $rating2 = 2;
            $comment2 = "Bad one.";
            $restaurant_id = $test_restaurant->getId();
            $test_review2 = new Review($username2, $date2, $rating2, $comment2, $restaurant_id, $id);
            $test_review2->save();

            $result = $test_restaurant->getReviews();

            $this->assertEquals([$test_review, $test_review2], $result);
        }
    }
?>
