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

        function testGetExample()
        {
            $word = "suspenders";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had rainbow-colored suspenders holding up his pants instead of a belt.";
            $test_US = new US($word, $definition, $example);

            $result = $test_US->getExample();

            $this->assertEquals($example, $result);

        }

        function testGetRegion()
        {
            $word = "Coke";
            $definition = "Any sweet carbonated beverage.";
            $example = "He had a grape coke with his burger.";
            $region = "South";
            $test_US = new US($word, $definition, $example, $region);

            $result = $test_US->getRegion();

            $this->assertEquals($region, $result);

        }

        function testGetId()
        {
            $id = 1;
            $word = "Coke";
            $definition = "Any sweet carbonated beverage.";
            $example = "He had a grape coke with his burger.";
            $region = "South";
            $test_US = new US($word, $definition, $example, $region, $id);

            $result = $test_US->getId();

            $this->assertEquals($id, $result);
        }

        function testSetWord()
        {
            $word = "suspender";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had rainbow-colored suspenders holding up his pants instead of a belt.";
            $test_US = new US($word, $definition, $example);
            $new_word = "suspenders";

            $test_US->setWord($new_word);
            $result = $test_US->getWord();


            $this->assertEquals($new_word, $result);
        }
    }


 ?>
