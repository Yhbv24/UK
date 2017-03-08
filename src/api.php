<?php
curl_init();
$accept = "application/json";

if(!empty($_GET['definition'])){
    $dictionary_url = 'https://od-api.oxforddictionaries.com/api/v1'. $_GET['definition'] . '/regions=gb';

    $dictionary_json = file_get_contents($dictionary_url);
    $definitions = json_decode($dictionary_json, true);

    $definition = $result['definitions'][0];
};
$definition = $_GET['search'];
$curl = curl_init();
$dictionary_url = curl_setopt($curl, CURLOPT_URL, "https://od-api.oxforddictionaries.com:443/api/v1/entries/en/" . $definition . "/regions=gb");

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
"Accept:". $accept, "app_id:" . "1ebc726a", "app_key:" . "693e18bfbed8265863ef38fc0a211262"));
$result = curl_exec($curl);
$exploded = explode("[",$result);
var_dump($result);
var_dump("exploded");
var_dump($exploded[7]);
$exploded_result = explode("]",$exploded);
curl_close($curl);
$dictionary_json = file_get_contents($dictionary_url);
$definitions = json_decode($dictionary_url, true);
$definition = $result['results'];
?>
