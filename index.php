<?php

echo 'I am ./server/api', PHP_EOL, $_SERVER['REQUEST_URI'];

require '/classes/Request.php';
use classes\Request;

$request = new Request();
var_dump($request);

$requestedURI = $_SERVER['REQUEST_URI'];

// Code below is an example of usage for Postgre

$dbopts = parse_url(getenv('DATABASE_URL'));
$app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
               array(
                'pdo.server' => array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["user"],
                   'password' => $dbopts["pass"],
                   'host' => $dbopts["host"],
                   'port' => $dbopts["port"],
                   'dbname' => ltrim($dbopts["path"],'/')
                   )
               )
);

$app->get('/db/', function() use($app) {
    $st = $app['pdo']->prepare('SELECT name FROM test_table');
    $st->execute();
  
    $names = array();
    while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
      $app['monolog']->addDebug('Row ' . $row['name']);
      $names[] = $row;
    }
  
    return $app['twig']->render('database.twig', array(
      'names' => $names
    ));
  });