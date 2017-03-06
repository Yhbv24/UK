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
}
 ?>
