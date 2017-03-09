<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/api.php";


$server = "mysql:host=localhost:8889;dbname=translator_test";
$username = "root";
$password = "root";
$DB = new PDO($server, $username, $password);

class SearchWordTest extends PHPUnit_Framework_TestCase
{
    function tearDown()
    {
        UK_word::deleteAll();
        US_word::deleteAll();
    }
    function test_apiSave()
    {
        // Arrange
        $word = "lorry";
        $definition = "a large car that carries things";
        $example = "the lorry obstructs my view";
        $new_word = new UK_word($word, $definition, $example);
        $new_word->save();

        // Act
        $result = SearchWord::getAll();

        // Assert
        $this->assertEquals($new_word, $result[0]);
    }

}
 ?>
