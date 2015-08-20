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

    class ReviewTest extends PHPUnit_Framework_TestCase
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

            //review
            $username = "Ben";
            $date = 0000-00-00;
            $rating = 5;
            $comment = "good one.";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($username, $date, $rating, $comment, $restaurant_id, $id);
            $test_review->save();

            $result = $test_review->getId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_restaurantId()
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

            //review
            $username = "Ben";
            $date = 0000-00-00;
            $rating = 5;
            $comment = "good one.";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($username, $date, $rating, $comment, $restaurant_id, $id);
            $test_review->save();

            $result = $test_review->getRestaurantId();

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

            //review
            $username = "Ben";
            $date = 0000-00-00;
            $rating = 5;
            $comment = "good one.";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($username, $date, $rating, $comment, $restaurant_id, $id);

            $test_review->save();

            $result = Review::getAll();
            $this->asserEquals($test_review, $result[0]);
        }

        function test_getAll()
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

            //review1
            $username = "Ben";
            $date = 0000-00-00;
            $rating = 5;
            $comment = "good one.";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($username, $date, $rating, $comment, $restaurant_id, $id);

            //review2
            $username2 = "Jen";
            $date2 = 1111-00-00;
            $rating2 = 2;
            $comment2 = "Bad one.";
            $restaurant_id = $test_restaurant->getId();
            $test_review2 = new Review($username2, $date2, $rating2, $comment2, $restaurant_id, $id);

            $result = Review::getAll();

            $this->assertEquals([$test_review, $test_review2], $result);
        }

        Function test_deleteAll()
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

            //review1
            $username = "Ben";
            $date = 0000-00-00;
            $rating = 5;
            $comment = "good one.";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($username, $date, $rating, $comment, $restaurant_id, $id);

            //review2
            $username2 = "Jen";
            $date2 = 1111-00-00;
            $rating2 = 2;
            $comment2 = "Bad one.";
            $restaurant_id = $test_restaurant->getId();
            $test_review2 = new Review($username2, $date2, $rating2, $comment2, $restaurant_id, $id);

            Review::deleteAll();

            $result = Review::getAll();
            $this->AssertEquals([], $result);
        }
    }
?>
