<?php
class UK_word
{
    private $word;
    private $definition;
    private $example;
    private $region;
    private $country;
    private $id;

    function __construct($word, $definition, $example, $region, $country = "UK", $id = null)
    {
        $this->word = $word;
        $this->definition = $definition;
        $this->example = $example;
        $this->region = $region;
        $this->country = "UK";
        $this->id = $id;

    }

    function setWord($new_word)
    {
         $this->word = $new_word;
    }
    function getWord()
    {
         return $this->word;
    }
    function setDefinition($new_definition)
    {
         $this->definition = $new_definition;
    }
    function getDefinition()
    {
         return $this->definition;
    }
    function setExample($new_example)
    {
         $this->example = $new_example;
    }
    function getExample()
    {
         return $this->example;
    }
    function setRegion($new_region)
    {
         $this->region = $new_region;
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
    function setId($id)
    {
         $this->id = $id;
    }
    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO uk_words (word, definition, example, region, country) VALUES ('{$this->getWord()}', '{$this->getDefinition()}', '{$this->getExample()}', '{$this->getRegion()}', '{$this->getCountry()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }
    static function getAll()
    {
        $returned_words = $GLOBALS['DB']->query("SELECT * FROM uk_words ORDER BY word;");
        $words = array();

        foreach ($returned_words as $uk_word) {
            $word = $uk_word["word"];
            $definition = $uk_word["definition"];
            $example = $uk_word["example"];
            $region = $uk_word["region"];
            $country = $word['country'];
            $id = $uk_word["id"];
            $uk_word = new UK_word($word, $definition, $example, $region, $country, $id);
            array_push($words, $uk_word);
        }

        return $words;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM uk_words;");
    }

    function update($new_word, $new_definition, $new_example, $new_region)
    {
        if($new_word){
        $GLOBALS['DB']->exec("UPDATE uk_words SET word = '{$new_word}' WHERE id = {$this->getId()};");
        $this->setWord($new_word);
        }
        if($new_region){
        $GLOBALS['DB']->exec("UPDATE uk_words SET region = '{$new_region}' WHERE id = {$this->getId()};");
        $this->setRegion($new_region);
        }
        if($new_example){
        $GLOBALS['DB']->exec("UPDATE uk_words SET example = '{$new_example}' WHERE id = {$this->getId()};");
        $this->setExample($new_example);
        }
        if($new_definition){
        $GLOBALS['DB']->exec("UPDATE uk_words SET definition = '{$new_definition}' WHERE id = {$this->getId()};");
        $this->setDefinition($new_definition);
        }
    }

    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM uk_words WHERE id = {$this->getId()};");
    }

    static function find($search_id)
    {
        $found_word = null;
        $words = UK_word::getAll();
        foreach ($words as $word) {
            $word_id = $this->getId();
            if($word_id == $search_id){
                $search_id = $found_word;
            }
            return $found_word;
        }

    }

    function addUSWord($us_id)
    {
        $GLOBALS['DB']->exec("INSERT INTO UK_US (UK_id, US_id) VALUES ({$this->getId()}, {$us_id});");
    }

   function getUSWords()
    {
        $returned_words = $GLOBALS['DB']->query("SELECT US_words.* FROM UK_words
        JOIN UK_US ON (UK_words.id = UK_US.uk_id)
        JOIN US_words ON (UK_US.us_id = US_words.id)
        WHERE UK_words.id = {$this->getId()};");
        $matches = array();
        foreach($returned_words as $word)
        {
            $id = $word['id'];
            $this_word = $word['word'];
            $example = $word['example'];
            $region = $word['region'];
            $country = $word['country'];
            $definition = $word['definition'];
            $word = new US_word($this_word, $definition, $example, $region, $country, $id);
            array_push($matches, $word);
        }
        return $matches;
    }
    static function search($search_word)
    {
        $found_us_words = $GLOBALS["DB"]->query("SELECT * FROM US_words WHERE word LIKE '%" . $search_word . "%';");
        $found_uk_words = $GLOBALS["DB"]->query("SELECT * FROM UK_words WHERE word LIKE '%" . $search_word . "%';");
        $output = array();
        foreach ($found_us_words as $word) {
            $id = $word['id'];
            $this_word = $word['word'];
            $example = $word['example'];
            $region = $word['region'];
            $country = $word['country'];
            $definition = $word['definition'];
            $word = new US_word($this_word, $definition, $example, $region, $country, $id);

            array_push($output, $word);
        }
        foreach ($found_uk_words as $word) {
            $id = $word['id'];
            $this_word = $word['word'];
            $example = $word['example'];
            $region = $word['region'];
            $country = $word['country'];
            $definition = $word['definition'];
            $word = new UK_word($this_word, $definition, $example, $region, $country, $id);
            array_push($output, $word);
        }
        return $output;
    }

    static function getboth()
    {
      $returned_words = $GLOBALS['DB']->query("SELECT * FROM uk_words");
      $usWords = $GLOBALS['DB']->query("SELECT * FROM us_words");
      $words =[];

      foreach ($returned_words as $uk_word) {
          $word = $uk_word["word"];
          $definition = $uk_word["definition"];
          $example = $uk_word["example"];
          $region = $uk_word["region"];
          $country = $uk_word['country'];
          $id = $uk_word["id"];
          $new_uk_words = new UK_word($word, $definition, $example, $region, $country, $id);
          array_push($words, $new_uk_words);
        }

      foreach($usWords as $usWord) {
          $word = $usWord['word'];
          $definition = $usWord['definition'];
          $example = $usWord['example'];
          $region = $usWord['region'];
          $country = $usWord['country'];
          $id = $usWord['id'];
          $new_us = new US_word($word, $definition, $example, $region, $country, $id);
          array_push($words, $new_us);
        }
        return $words;
    }

}
 ?>
