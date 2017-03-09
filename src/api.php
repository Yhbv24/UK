<?php
class SearchWord
{
    private $search_word;
    private $definition;
    private $example;
    private $region;
    private $country;
    private $id;

    function __construct($search_word, $definition, $example, $region, $country = "UK", $id=null)
    {
        $this->search_word = $search_word;
        $this->definition = $definition;
        $this->example = $example;
        $this->region = $region;
        $this->country = "UK";
        $this->id = $id;
    }

    static function apiCall($search_word)
    {
    curl_init();
    $accept = "application/json";

    // $search_word = $_GET['search'];
    $curl = curl_init();
    $dictionary_url = curl_setopt($curl, CURLOPT_URL, "https://od-api.oxforddictionaries.com:443/api/v1/entries/en/" . $search_word . "/regions=gb");

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "Accept:". $accept, "app_id:" . "1ebc726a", "app_key:" . "693e18bfbed8265863ef38fc0a211262"));
    $result = curl_exec($curl);
    curl_close($curl);

    $decoded = json_decode($result, true);
    $api_definition = $decoded['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0]['definitions'][0];
    $api_example = $decoded['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0]['examples'][0]['text'];
    $api_region = $decoded['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0]['regions'][0];
    $country = "UK";
    $new_word = new SearchWord($search_word, $api_definition, $api_example, $api_region);

    $GLOBALS['DB']->exec("INSERT INTO uk_words (word, definition, example, region, country) VALUES ('{$search_word}', '{$api_definition}', '{$api_example}', '{$api_region}', '{$country}');");
    $new_word->id = $GLOBALS['DB']->lastInsertId();

    // return $new_word;
    }
}
?>
