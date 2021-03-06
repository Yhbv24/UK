<?php
    date_default_timezone_set("America/Los_Angeles");

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/UK.php";
    require_once __DIR__."/../src/US.php";
    require_once __DIR__."/../src/api.php";

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
        $words = Uk_word::getBoth();
        return $app["twig"]->render("index.html.twig", array('words' => $words));
    });

    $app->get("/search", function() use ($app) { // Searches both US and UK tables despite name
        $search_word = strtolower($_GET['search']);
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
        } elseif ($word_match->getCountry() == "US") {
            $UK_word = $word_match->getUKWords();
        } else {
            $US_word = $word_match->getUSWords();
        }

        return $app["twig"]->render("search.html.twig", array("output" => $output, "UK_word" => $UK_word, "US_word" => $US_word, 'word_match'=>$word_match));
        });


    $app->get('/add_US_word', function() use ($app) {
        return $app['twig']->render('add_us_word.html.twig');
    });

    $app->post('/add_US_word', function() use ($app) {
        $us_word = $_POST['us_word'];
        $us_definition = $_POST['definition'];
        $us_example = $_POST['example'];
        $us_region = $_POST['us_region'];
        $new_word = new US_word($us_word, $us_definition, $us_example, $us_region, $country = "US");
        $new_word->save();

        $uk_word = $_POST['uk_word'];
        $uk_definition = $_POST['uk_definition'];
        $uk_example = $_POST['uk_example'];
        $uk_region = $_POST['uk_region'];
        $new_uk_word = new UK_word($uk_word, $uk_definition, $uk_example, $uk_region, $country = "UK");
        $new_uk_word->save();



        if ($new_uk_word->getId() != 0 && $new_word->getId() != 0) {
            $new_word->addUKWord($new_uk_word->getId());
        }else {
            $new_word = "";
            $new_uk_word = "";
        };


        return $app["twig"]->render("confirm_add.html.twig", array('new_us_word'=>$new_word, 'new_uk_word'=>$new_uk_word));
    });

    $app->post('/delete_all', function() use ($app) {
        UK_word::deleteAll();
        US_word::deleteAll();
        $GLOBALS['DB']->exec("DELETE FROM UK_US;");

        return $app->redirect("/");
    });

    $app->get('/complete_list', function() use ($app) {
        $uk_words = UK_word::getAll();
        $us_words = US_word::getAll();

        return $app['twig']->render('word_list.html.twig', array('us_words'=>$us_words, 'uk_words'=>$uk_words));
    });

    $app->get("/add_word", function() use($app){
        return $app["twig"]->render("add_us_word.html.twig");
    });

    $app->get("/map", function() use($app){
        return $app["twig"]->render("map.html.twig");
    });


    $app->get("/uk_link/{id}", function($id) use($app) {
        $UK_word = UK_word::find($id);
        $US_word =$UK_word->getUSWords();
        return $app["twig"]->render("uk_link.html.twig", array("UK_word" => $UK_word, "US_word" => $US_word));
    });

    $app->get("/us_link/{id}", function($id) use($app) {
        $US_word = US_word::find($id);
        $UK_word =$US_word->getUKWords();
        return $app["twig"]->render("us_link.html.twig", array("UK_word" => $UK_word, "US_word" => $US_word));
    });

    return $app;
?>
