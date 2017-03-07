<?php

curl -X GET --header "Accept: application/json" --header "app_id: 1ebc726a" --header "app_key: 693e18bfbed8265863ef38fc0a211262" "https://od-api.oxforddictionaries.com:443/api/v1/entries/en/candy/regions=gb"

$_GET['definition'];

$dictionary_url = 'https://od-api.oxforddictionaries.com/api/v1'.$_GET['definition'];

$dictionary_json = file_get_contents($dictionary_url);

$dictionary_array =json_decode($dictionary_json, true);

$definition = $dictionary_array["senses"][2][definitions]["string"];
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>test</title>
    </head>
    <body>
        <form action="" method="post">
            <label for="word">Enter a word </label>
            <input type="text" name="name" value="">
            <button type="submit">search</button>
        </form>

        foreach($dictionary_array['definition'] as $word){
            echo $word;
        };
    </body>
</html>
