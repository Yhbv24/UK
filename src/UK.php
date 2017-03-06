<?php
class UK_word
{
    private $word;
    private $definition;
    private $example;
    private $region;
    private $id;

    function __construct($word, $definition, $example, $region = "UK",  $id = null)
    {
        $this->word = $word;
        $this->definition = $definition;
        $this->example = $example;
        $this->region = $region;
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
        $GLOBALS['DB']->exec("INSERT INTO uk_words (word, definition, example, region) VALUES ('{$this->getWord()}', '{$this->getDefinition()}', '{$this->getExample()}', '{$this->getRegion()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }
    static function getAll()
    {
        $returned_words = $GLOBALS['DB']->query("SELECT * FROM uk_words;");
        $words = array();

        foreach ($returned_words as $uk_word) {
            $word = $uk_word["word"];
            $definition = $uk_word["definition"];
            $example = $uk_word["example"];
            $region = $uk_word["region"];
            $id = $uk_word["id"];
            $uk_word = new UK_word($word, $definition, $example, $region, $id);
            array_push($words, $uk_word);
        }

        return $words;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM uk_words;");
    }
}
 ?>
