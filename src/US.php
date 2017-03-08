<?php
    class US_word
    {
        private $word;
        private $definition;
        private $example;
        private $region;
        private $country;
        private $id;

        function __construct($word, $definition, $example, $region, $country = "US", $id=null)
        {
            $this->word = $word;
            $this->definition = $definition;
            $this->example = $example;
            $this->region = $region;
            $this->country = "US";
            $this->id = $id;
        }


        // GETTERS AND SETTERS
        function getWord()
        {
            return $this->word;
        }

        function getDefinition()
        {
            return $this->definition;
        }

        function getExample()
        {
            return $this->example;
        }

        function getRegion()
        {
            return $this->region;
        }

        function getCountry()
        {
            return $this->country;
        }

        function getId()
        {
            return $this->id;
        }

        function setWord($new_word)
        {
            $this->word = (string)$new_word;
        }

        function setDefinition($new_definition)
        {
            $this->definition = (string)$new_definition;
        }

        function setExample($new_example)
        {
            $this->example = (string)$new_example;
        }

        function setRegion($new_region)
        {
            $this->region = (string)$new_region;
        }

        function save()
        {
            $new_US = $GLOBALS['DB']->exec("INSERT INTO us_words (word, definition, example, region, country) VALUES ('{$this->getWord()}', '{$this->getDefinition()}', '{$this->getExample()}', '{$this->getRegion()}', '{$this->getCountry()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();

        }

        static function getAll()
        {
            $usWords = $GLOBALS['DB']->query("SELECT * FROM us_words ORDER BY word;");
            $word_array = array();
            foreach($usWords as $usWord) {
                $word = $usWord['word'];
                $definition = $usWord['definition'];
                $example = $usWord['example'];
                $region = $usWord['region'];
                $country = $word['country'];
                $id = $usWord['id'];
                $new_us = new US_word($word, $definition, $example, $region, $country, $id);
                array_push($word_array, $new_us);
            }
            return $word_array;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM us_words;");
        }

        function update($property, $value)
        {
            $GLOBALS['DB']->exec("UPDATE us_words SET {$property} = {$value} WHERE id = {$this->id};");
            $this->$property = $value;
        }

        static function find($id)
        {
            $returned_US_words = $GLOBALS['DB']->query("SELECT * FROM us_words WHERE id={$id};");


            foreach($returned_US_words as $us_word){
                $word = $us_word['word'];
                $definition = $us_word['definition'];
                $example = $us_word['example'];
                $region = $us_word['region'];
                $country = $word['country'];
                $id = $us_word['id'];
                $new_us_word = new US_word($word, $definition, $example, $region, $country, $id);
            }
            return $new_us_word;
        }

        function addUKWord($uk_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO UK_US (uk_id, us_id) VALUES ({$uk_id}, {$this->id});");

        }

        function getUKWords()
        {
            $returned_words = $GLOBALS['DB']->query("SELECT uk_words.* FROM us_words
            JOIN uk_us ON (us_words.id = uk_us.us_id)
            JOIN uk_words ON(uk_us.uk_id = uk_words.id)
            WHERE us_words.id = {$this->getId()};");
            $matches = array();
            foreach($returned_words as $uk_word) {
                $word = $uk_word['word'];
                $definition = $uk_word['definition'];
                $example = $uk_word['example'];
                $region = $uk_word['region'];
                $country = $word['country'];
                $id = $uk_word['id'];
                $new_UK = new UK_word($word, $definition, $example, $region, $country, $id);
                array_push($matches, $new_UK);
            }
            return $matches;
        }


    }
 ?>
