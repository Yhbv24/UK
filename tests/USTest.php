<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/US.php";

    $server = 'mysql:host=localhost:8889;dbname=translator_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class USTest extends PHPUnit_Framework_TestCase

    {
        function testGetWord()
        {
            $word = "suspenders";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had rainbow-colored suspenders holding up his pants instead of a belt.";
            $test_US = new US($word, $definition, $example);

            $result = $test_US->getWord();

            $this->assertEquals($word, $result);

        }

        function testGetDefinition()
        {
            $word = "suspenders";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had rainbow-colored suspenders holding up his pants instead of a belt.";
            $test_US = new US($word, $definition, $example);

            $result = $test_US->getDefinition();

            $this->assertEquals($definition, $result);

        }

        function testGetExamplt()
        {
            $word = "suspenders";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had rainbow-colored suspenders holding up his pants instead of a belt.";
            $test_US = new US($word, $definition, $example);

            $result = $test_US->getExample();

            $this->assertEquals($example, $result);

        }
    }


 ?>
