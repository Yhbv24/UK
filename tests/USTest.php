<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/US.php";
    require_once "src/UK.php";

    $server = 'mysql:host=localhost:8889;dbname=translator_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class USTest extends PHPUnit_Framework_TestCase

    {
        protected function tearDown()
        {
            US_word::deleteAll();
            UK_word::deleteAll();
        }

        // GETTERS AND SETTERS TESTS
        function testGetWord()
        {
            $word = "suspenders";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had rainbow-colored suspenders holding up his pants instead of a belt.";
            $test_US = new US_word($word, $definition, $example);

            $result = $test_US->getWord();

            $this->assertEquals($word, $result);

        }

        function testGetDefinition()
        {
            $word = "suspenders";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had rainbow-colored suspenders holding up his pants instead of a belt.";
            $test_US = new US_word($word, $definition, $example);

            $result = $test_US->getDefinition();

            $this->assertEquals($definition, $result);

        }

        function testGetExample()
        {
            $word = "suspenders";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had rainbow-colored suspenders holding up his pants instead of a belt.";
            $test_US = new US_word($word, $definition, $example);

            $result = $test_US->getExample();

            $this->assertEquals($example, $result);

        }

        function testGetRegion()
        {
            $word = "Coke";
            $definition = "Any sweet carbonated beverage.";
            $example = "He had a grape coke with his burger.";
            $region = "South";
            $test_US = new US_word($word, $definition, $example, $region);

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
            $test_US = new US_word($word, $definition, $example, $region, $id);

            $result = $test_US->getId();

            $this->assertEquals($id, $result);
        }

        function testSetWord()
        {
            $word = "suspender";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had rainbow-colored suspenders holding up his pants instead of a belt.";
            $test_US = new US_word($word, $definition, $example);
            $new_word = "suspenders";

            $test_US->setWord($new_word);
            $result = $test_US->getWord();


            $this->assertEquals($new_word, $result);
        }

        function testSetDefinition()
        {
            $word = "suspender";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had rainbow-colored suspenders holding up his pants instead of a belt.";
            $test_US = new US_word($word, $definition, $example);

            $new_definition = "Cables for construction";

            $test_US->setDefinition($new_definition);
            $result = $test_US->getDefinition();

            $this->assertEquals($new_definition, $result);
        }

        function testSetExample()
        {
            $word = "suspender";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had rainbow-colored suspenders holding up his pants instead of a belt.";
            $test_US = new US_word($word, $definition, $example);
            $new_example = "rainbow-colored";


            $test_US->setExample($new_example);
            $result = $test_US->getExample();
            $this->assertEquals($new_example, $result);

        }

        function testSetRegion()
        {
            $word = "Coke";
            $definition = "Any sweet carbonated beverage.";
            $example = "He had a grape coke with his burger.";
            $region = "South";
            $test_US = new US_word($word, $definition, $example, $region);

            $new_region = "Southeast";

            $test_US->setRegion($new_region);
            $result = $test_US->getRegion();

            $this->assertEquals($new_region, $result);
        }

        function testSave()
        {
            $word = "suspenders";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had suspenders holding up his pants instead of a belt.";
            $test_US = new US_word($word, $definition, $example);

            $test_US->save();
            $result = US_word::getAll();

            $this->assertEquals([$test_US], $result);
        }

        function testGetAll()
        {
            $word = "Coke";
            $definition = "Any sweet carbonated beverage.";
            $example = "He had a grape coke with his burger.";
            $test_US = new US_word($word, $definition, $example);
            $test_US->save();

            $word2 = "suspenders";
            $definition2 = "Elastic straps that hold up pants.";
            $example2 = "He had suspenders holding up his pants instead of a belt.";
            $test_US2 = new US_word($word2, $definition2, $example2);
            $test_US2->save();

            $result = US_word::getAll();

            $this->assertEquals([$test_US, $test_US2], $result);
        }

        function testDeleteAll()
        {
            $word = "Coke";
            $definition = "Any sweet carbonated beverage.";
            $example = "He had a grape coke with his burger.";
            $region = "South";
            $test_US = new US_word($word, $definition, $example, $region);
            $test_US->save();

            $word2 = "suspenders";
            $definition2 = "Elastic straps that hold up pants.";
            $example2 = "He had suspenders holding up his pants instead of a belt.";
            $test_US2 = new US_word($word2, $definition2, $example2);
            $test_US2->save();

            US_word::deleteAll();
            $result = US_word::getAll();

            $this->assertEquals([], $result);
        }

        function testUpdate()
        {
            $word = "suspenders";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had suspenders holding up his pants instead of a belt.";
            $test_US = new US_word($word, $definition, $example, $region, $country);
            $test_US->save();
            $update_word = "truck";

            $test_US->update('word', $update_word );
            $result = $test_US->getWord();

            $this->assertEquals($update_word, $result);
        }


        function testFind()
        {
            $word = "suspenders";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had suspenders holding up his pants instead of a belt.";
            $new_US = new US_word($word, $definition, $example);
            $new_US->save();

            $word2 = "truck";
            $definition2 = "Big vehicle for transporting goods.";
            $example2 = "He drove a truck for amazon deliveries.";
            $new_US2 = new US_word($word2, $definition2, $example2);
            $new_US2->save();

            $us_id = $new_US->getId();
            $result = US_word::find($us_id);

            $this->assertEquals($new_US, $result);
        }

        function testGetAndAddUkWords()
        {
            $word = "suspenders";
            $definition = "Elastic straps that hold up pants.";
            $example = "He had suspenders holding up his pants instead of a belt.";
            $new_US = new US_word($word, $definition, $example);
            $new_US->save();

            $word2 = "braces";
            $definition2 = "Elastic straps that hold up trousers.";
            $example2 = "He had braces holding up his trousers instead of a belt.";
            $new_UK = new UK_word($word2, $definition2, $example2);
            $new_UK->save();


            $new_US->addUKWord($new_UK->getId());

            $result = $new_US->getUKWords();

            $this->assertEquals($new_UK, $result[0]);
        }


    }


 ?>
