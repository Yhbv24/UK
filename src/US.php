<?php
    class US
    {
        private $word;
        private $definition;
        private $example;
        private $region;
        private $id;

        function __construct($word, $definition, $example, $region=null, $id=null)
        {
            $this->word = $word;
            $this->definition = $definition;
            $this->example = $example;
            $this->region = $region;
            $this->id = $id;
        }

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
            
        }

        function setId()
        {

        }
    }
 ?>
