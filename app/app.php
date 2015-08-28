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

    //Add a brand to a store:
    $app->post('/add_brands', function() use ($app) {
        $brand = Brand::find($_POST['brand_id']);
        $store = Store::find($_POST['store_id']);
        $store->addBrand($brand);
        return $app['twig']->render('store.html.twig', array(
            'store' => $store,
            'brands' => $store->getBrands(),
            'all_brands' => Brand::getAll()
        ));
    });

    //Update the name of a store:
    $app->patch('/store/{id}/edit', function($id) use ($app) {
        $new_store_name = $_POST['new_store_name'];
        $store = Store::find($id);
        $store->update($new_store_name);
        return $app['twig']->render('store.html.twig', array (
            'store' => $store,
            'brands' => $store->getBrands(),
            'all_brands' => Brand::getAll()
        ));
    });

    //Delete a store:
    $app->delete('/store/{id}/edit', function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('index.html.twig', array (
            'stores' => Store::getAll(),
            'brands' => Brand::getAll()
        ));
    });

    $app->get('/store/{id}/edit', function() use ($app) {
        return $app['twig']->render('index.html.twig', array(
            'stores' => Store::getAll(),
            'brands' => Brand::getAll()
        ));
    });

    /* ------------- Begin brand routes: -------------- */

    $app->get('/brands', function() use ($app) {
        return $app['twig']->render('index.html.twig', array(
            'stores' => Store::getAll(),
            'brands' => Brand::getAll()
        ));
    });

    //Adds a new brand, renders index:
    $app->post('/brands', function() use ($app) {
        $brand_name = $_POST['brand_name'];
        $brand = new Brand($brand_name, $id=null);
        $brand->save();
        return $app['twig']->render('index.html.twig', array(
            'stores' => Store::getAll(),
            'brands' => Brand::getAll()
        ));
    });

    //Clear all brands, renders index:
    $app->post('/delete_brands', function () use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('index.html.twig', array(
            'stores' => Store::getAll(),
            'brands' => Brand::getAll()
        ));
    });


























    return $app;

?>
