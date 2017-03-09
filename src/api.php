<?php
curl_init();
$accept = "application/json";

$search = $_GET['search'];
$curl = curl_init();
$dictionary_url = curl_setopt($curl, CURLOPT_URL, "https://od-api.oxforddictionaries.com:443/api/v1/entries/en/" . $search . "/regions=gb");

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
"Accept:". $accept, "app_id:" . "1ebc726a", "app_key:" . "693e18bfbed8265863ef38fc0a211262"));
$result = curl_exec($curl);
$exploded = explode("[",$result);
var_dump($exploded);
$definition = $exploded[7];
$definition = explode("]",$definition);
$definition = $definition[0];
var_dump($definition);
$example = $exploded[9];
$example = explode("]",$example);
$example = $example[0];
var_dump($example);
// var_dump($definition[0]);
curl_close($curl);

?>
