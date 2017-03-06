<?php
    /*
    /** @backupGlobals disabled
    /** @backupStaticAttributes disabled
    */

    require_once "src/UK.php";

    $server = "mysql:host=localhost:8889;dbname=translator_test";
    $username = "user";
    $password = "user";
    $DB = new PDO($server, $username, $password);

    class UKTest extends PHPUnit_Framework_TestCase
    {
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
    }
 ?>
