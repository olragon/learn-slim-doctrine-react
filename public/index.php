<?php
require '../vendor/autoload.php';

use \Slim\Slim;

$app = new Slim([
  'debug' => true,
]);

$app->get('/', function () {
  echo 'Homepage';
});

$app->get('/item/:id', function ($id) {
  echo $id;
});

$app->run();