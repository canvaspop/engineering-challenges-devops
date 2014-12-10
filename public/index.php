<?php
require '../vendor/autoload.php';

//load configuration
if( getenv( 'APPLICATION_ENV' ) == 'production' )
    \lib\Config::writeBulk( require '../config/config.production.php' );
else
    \lib\Config::writeBulk( require '../config/config.local.php' );

\lib\Config::write( 'environment', getenv( 'APPLICATION_ENV' ) );

// Prepare app
$app = new \Slim\Slim(
    array(
        'templates.path' => '../templates',
    )
);

// Create monolog logger and store logger in container as singleton
// (Singleton resources retrieve the same log resource definition each time)
$app->container->singleton( 'log', function ()
{
    $log = new \Monolog\Logger( 'slim-skeleton' );
    $log->pushHandler( new \Monolog\Handler\StreamHandler( '../logs/app.log', \Monolog\Logger::DEBUG ) );

    return $log;
} );

// Prepare view
$app->view( new \Slim\Views\Twig() );
$app->view->parserOptions    = array(
    'charset'          => 'utf-8',
    'cache'            => realpath( '../templates/cache' ),
    'auto_reload'      => true,
    'strict_variables' => false,
    'autoescape'       => true
);
$app->view->parserExtensions = array( new \Slim\Views\TwigExtension() );
$app->view->set( 'asset_path', \lib\Config::read( 'asset.path' ) );
$app->view->set( 'environment', \lib\Config::read( 'environment' ) );

$app->get( '/', function () use ( $app )
{
    // Sample log message
    $app->log->info( "Slim-Skeleton '/' route" );
    // Render index view
    $app->render( 'index.html' );
} );

$app->group( '/companies', function () use ( $app )
{
    // get list of companies
    $app->get( '', function () use ( $app )
    {
        //retrieve a list of companies from the database
        $companyMapper = new \models\Company();
        $app->render( 'companies/list.html', array( 'companies' => $companyMapper->fetchAll() ) );
    } );

    // get company properties
    $app->get( '/:id', function ( $id ) use ( $app )
    {
        //retrieve the specified company from the database
        $companyMapper = new \models\Company();

        $app->render( 'companies/edit.html', array( 'company' => $companyMapper->fetchById( $id ) ) );
    } );

    // update company properties
    $app->post( '/:id', function ( $id ) use ( $app )
    {
        //save the specified company in the database
        $companyMapper = new \models\Company();
        $companyMapper->update( $app->request->post( 'id' ), $app->request->post( 'name' ), $app->request->post( 'url' ) );

        $app->redirect( '/companies' );
    } );
} );

$app->group( '/locations', function () use ( $app )
{
    // get list of locations
    $app->get( '', function () use ( $app )
    {
        //retrieve a list of locations from the cache
        $locationMapper = new \models\Location();

        $app->render( 'locations/list.html', array( 'locations' => $locationMapper->fetchAll() ) );
    } );

    // prime the list of locations
    $app->get( '/populate', function () use ( $app )
    {
        //retrieve a list of locations from the cache
        $locationMapper = new \models\Location();
        $locationMapper->populate();

        $app->redirect( '/locations' );
    } );
} );

// Run app
$app->run();