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
        $UK_word = null;
        $US_word = null;
        $word_match = null;

        if (!$output) {
            $word_match = "";
        } else {
            $word_match = $output[0];
        }

        if (!$output) {
            $word_match = "";
        } elseif ($word_match->getRegion() == "US") {
            $UK_word = $word_match->getUKWords();
        } else {
            $US_word = $word_match->getUSWords();
        }

        return $app["twig"]->render("search.html.twig", array("output" => $output, "UK_word" => $UK_word, "US_word" => $US_word));
    });

    $app->post("/", function() use ($app) {
        $search_word = $_POST["us_word"];
        UK_word::searchUSWords($search_word);
        $uk_words = UK_word::getAll();
        $us_words = US_word::getAll();
        return $app['twig']->render("index.html.twig", array("search" => $search_word, 'us_words'=>$us_words, 'uk_words'=>$uk_words));
    });

    $app->get('/add_US_word', function() use ($app) {
        return $app['twig']->render('add_us_word.html.twig');
    });

    $app->post('/add_US_word', function() use ($app) {
        $us_word = $_POST['us_word'];
        $us_definition = $_POST['definition'];
        $us_example = $_POST['example'];
        $us_region = $_POST['region'];
        $new_word = new US_word($us_word, $us_definition, $us_example, $us_region);
        $new_word->save();

        $uk_word = $_POST['uk_word'];
        $uk_definition = $_POST['uk_definition'];
        $uk_example = $_POST['uk_example'];
        $uk_region = $_POST['uk_region'];
        $new_uk_word = new UK_word($uk_word, $uk_definition, $uk_example, $uk_region);
        $new_uk_word->save();

        $new_uk_word->addUSWord($new_word->getId());

        return $app->redirect('/');
    });

    $app->post('/delete_all', function() use ($app) {
        UK_word::deleteAll();
        US_word::deleteAll();
        $GLOBALS['DB']->exec("DELETE FROM UK_US;");

        return $app->redirect("/");
    });

    $app->get('/view_all', function() use ($app) {
        $uk_words = UK_word::getAll();
        $us_words = US_word::getAll();
        return $app['twig']->render('word_list.html.twig', array('us_words'=>$us_words, 'uk_words'=>$uk_words));
    });


    return $app;
