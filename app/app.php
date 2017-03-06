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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => __DIR__."/../views"));
    // ***** Routing *****
    // ***** Get routes *****

    $app->get("/", function() use ($app) { // Route to the home page
        return $app["twig"]->render("index.html.twig", array("uk_words" => $found_uk_words));
    });
    $app->post("/", function() use ($app) {
        $search_word = $_POST["uk_word"];
        $found_uk_words = $search_word->getUSWord();
        return $app->redirect('/');
    });
return $app;
