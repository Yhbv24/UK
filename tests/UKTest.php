<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/UK.php";
    require_once"src/US.php";

    $server = "mysql:host=localhost:8889;dbname=translator_test";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    class UKTest extends PHPUnit_Framework_TestCase
    {
        function tearDown()
        {
            UK_word::deleteAll();
            US_word::deleteAll();
        }
        function test_getName()
        {
            // Arrange
            $word = "lorry";
            $definition = "a large car that carries things";
            $example = "the lorry obstructs my view";
            $new_word = new UK_word($word, $definition, $example);

            // Act
            $result = $new_word->getWord();

            // Assert
            $this->assertEquals($word, $result);
        }

        function test_getDefinition()
        {
            // Arrange
            $word = "lorry";
            $definition = "a large car that carries things";
            $example = "the lorry obstructs my view";
            $new_word = new UK_word($word, $definition, $example);

            // Act
            $result = $new_word->getDefinition();

            // Assert
            $this->assertEquals($definition, $result);
        }

        function test_getExample()
        {
            // Arrange
            $word = "lorry";
            $definition = "a large car that carries things";
            $example = "the lorry obstructs my view";
            $new_word = new UK_word($word, $definition, $example);

            // Act
            $result = $new_word->getExample();

            // Assert
            $this->assertEquals($example, $result);
        }

        function test_setExample()
        {
            // Arrange
            $word = "lorry";
            $definition = "a large car that carries things";
            $example = "the lorry obstructs my view";
            $new_word = new UK_word($word, $definition, $example);

            // Act
            $new_example = "there is a large lorry in my way";
            $new_word->setExample($new_example);
            $result = $new_word->getExample();

            // Assert
            $this->assertEquals($new_example, $result);
        }

        function test_Save()
        {
            // Arrange
            $word = "lorry";
            $definition = "a large car that carries things";
            $example = "the lorry obstructs my view";
            $new_word = new UK_word($word, $definition, $example);
            $new_word->save();

            // Act
            $result = UK_word::getAll();

            // Assert
            $this->assertEquals($new_word, $result[0]);
        }

        function test_update()
        {
            // Arrange
            $word = "lorry";
            $definition = "a large car that carries things";
            $example = "the lorry obstructs my view";
            $region = "UK";
            $new_word = new UK_word($word, $definition, $example, $region);
            $new_word->save();

            // Act
            $update_word = "lolly";
            $update_definition ="candy";
            $update_example = "this lolly tastes good";
            $update_region = "UK";
            $new_word->update($update_word, $update_definition, $update_example, $update_region);
            $result = UK_word::getAll();

            //Assert
            $this->assertEquals($new_word, $result[0]);
        }

        function test_delete()
        {
            //Arrange
            $word = "lorry";
            $definition = "a large car that carries things";
            $example = "the lorry obstructs my view";
            $region = "UK";
            $new_word = new UK_word($word, $definition, $example, $region);
            $new_word->save();

            //Act
            $new_word->delete();
            $result = UK_word::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $word = "lorry";
            $definition = "a large car that carries things";
            $example = "the lorry obstructs my view";
            $region = "UK";
            $new_word = new UK_word($word, $definition, $example, $region);
            $new_word->save();

            $word2 = "lorry";
            $definition2 = "a large car that carries things";
            $example2 = "the lorry obstructs my view";
            $region2 = "UK";
            $new_word2 = new UK_word($word2, $definition2, $example2, $region2);
            $new_word2->save();

            //Act
            $result= $new_word->getId();

            //Assert
            $this->assertEquals($new_word->getId(), $result);

        }

        // function test_findUSWord()
        // {
        //     $word = "lorry";
        //     $definition = "a large car that carries things";
        //     $example = "the lorry obstructs my view";
        //     $region = "UK";
        //     $new_word = new UK_word($word, $definition, $example, $region);
        //     $new_word->save();
        //
        //     $word = "truck";
        //     $definition = "a large car that carries things";
        //     $example = "the truck obstructs my view";
        //     $region = "US";
        //
        //     $new_us_word = new US_word($word, $definition, $example, $region);
        //     $new_us_word->save();
        //
        //     $word = "18 wheeler";
        //     $definition = "a large car that carries things";
        //     $example = "the truck obstructs my view";
        //     $region = "US";
        //     $new_us_word = new US_word($word, $definition, $example, $region);
        //     $new_us_word->save();
        //     $result =
        //     //Act
        //     $this->assertEquals($new_us_word, $result);
        // }

    }
 ?>
