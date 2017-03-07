<?php
    date_default_timezone_set("America/Los_Angeles");

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/UK.php";
    require_once __DIR__."/../src/US.php";

    $app = new Silex\Application();

    $server = "mysql:host=localhost:8889;dbname=translator";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    $app["debug"] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => __DIR__."/../views"));
    // ***** Routing *****
    // ***** Get routes *****

    $app->get("/", function() use ($app) { // Route to the home page
        return $app["twig"]->render("index.html.twig");
    });

    $app->get("/search", function() use ($app) { // Searches both US and UK tables despite name
        $search_word = strtolower($_GET["search"]);
        $output = UK_word::search($search_word);
        $word_match = $output[0];
        $UK_word = null;
        $US_word = null;

        if ($word_match->getRegion() == "US") {
            $UK_word = $word_match->getUKWords();
        } else {
            $US_word = $word_match->getUSWords();
        }

        return $app["twig"]->render("search.html.twig", array("output" => $output, "UK_word" => $UK_word, "US_word" => $US_word));
    });

    return $app;
