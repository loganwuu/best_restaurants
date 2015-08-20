<?php
    class Review
    {
        private $username;
        private $date;
        private $rating;
        private $comment;
        private $id;
        private $restaurant_id;

        function __construct($username, $date, $rating, $comment, $restaurant_id, $id=null)
        {
            $this->username = $username;
            $this->date = $date;
            $this->rating = $rating;
            $this->comment = $comment;
            $this->restaurant_id = $restaurant_id;
            $this->id = $id;
        }

        function setUsername($new_username)
        {
            $this->username = (string) $new_username;
        }

        function getUsername()
        {
            return $this->username;
        }

        function setDate($new_date)
        {
            $this->date = $new_date;
        }

        function getDate()
        {
            return $this->date;
        }

        function setRating($new_rating)
        {
            $this->rating = (int) $new_rating;
        }

        function getRating()
        {
            return $this->rating;
        }

        function setComment($new_comment)
        {
            $this->comment-> (string) $new_comment;
        }

        function getComment()
        {
            return $this->comment;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function getRestaurantId()
        {
            return $this->restaurant_id;
        }
        
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO reviews (username, date, rating, comment, restaurant_id) VALUES ('{$this->getUsername()}', '{$this->getDate()}', {$this->getRating()}, '{$this->getComment()}', {$this->getRestaurantId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews;");
            $reviews = array();
            foreach($returned_reviews as $review) {
                $username = $review['username'];
                $date = $review['date'];
                $rating = $review['rating'];
                $comment = $review['comment'];
                $id = $review['id'];
                $restaurant_id = $review['restaurant_id'];
                $new_review = new Review ($username, $date, $rating, $comment, $restaurant_id, $id);
                array_push($reviews, $new_review);
            }
            return $reviews;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews;");
        }
    }
?>
