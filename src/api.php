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
curl_close($curl);

$decoded = json_decode($result, true);
echo '<pre>' . print_r($decoded, 1) . '<pre>';

$definition = $decoded['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0]['definitions'][0];
$example = $decoded['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0]['examples'][0]['text'];
$region = $decoded['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0]['regions'][0];
echo $region;
?>
