<?php
    //Dependencies:
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $app = new Silex\Application();
    $app['debug'] = true;

    //Point app to server:
    $server = 'mysql:host=localhost:3306;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    //Necessary for patch and delete routes:
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    //Index: Shows lists of brands and stores:
    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.html.twig', array(
            'stores' => Store::getAll(),
            'brands' => Brand::getAll()
        ));
    });

    /* ------------ Begin store routes: -------------- */

    $app->get('/stores', function() use ($app) {
        return $app['twig']->render('index.html.twig', array(
            'stores' => Store::getAll(),
            'brands' => Brand::getAll()
        ));
    });

    //Adds a new store, renders index:
    $app->post('/stores', function() use ($app) {
        $store_name = $_POST['store_name'];
        $store = new Store($store_name, $id=null);
        $store->save();
        return $app['twig']->render('index.html.twig', array(
            'stores' => Store::getAll(),
            'brands' => Brand::getAll()
        ));
    });

    //Clear all stores, renders index:
    $app->post('/delete_stores', function () use ($app) {
        Store::deleteAll();
        return $app['twig']->render('index.html.twig', array(
            'stores' => Store::getAll(),
            'brands' => Brand::getAll()
        ));
    });

    //View a store in detail:
    $app->get('/store/{id}', function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array(
            'store' => $store,
            'brands' => $store->getBrands(),
            'all_brands' => Brand::getAll()
        ));
    });




























    return $app;

?>
