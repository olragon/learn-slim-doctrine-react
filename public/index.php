<?php
require '../vendor/autoload.php';

use \Slim\Slim;

define('PUBLIC_DIR', dirname(__FILE__));
define('ROOT_DIR', dirname(PUBLIC_DIR . '../'));

$app = new Slim([
    'debug' => true,
]);

$app->get('/', function () {
    echo 'Homepage';
});

// Get
$app->get('/api/v1/:resource(/(:id)(/))', function($resource, $id = null) {
    $resource = \App\Resource::load($resource);
    if ($resource === null) {
        \App\Resource::response(\App\Resource::STATUS_NOT_FOUND);
    } else {
        $resource->get($id);
    }
});
// Post
$app->post('/api/v1/:resource(/)', function($resource) {
    $resource = \App\Resource::load($resource);
    if ($resource === null) {
        \App\Resource::response(\App\Resource::STATUS_NOT_FOUND);
    } else {
        $resource->post();
    }
});
// Put
$app->put('/api/v1/:resource/:id(/)', function($resource, $id = null) {
    $resource = \App\Resource::load($resource);
    if ($resource === null) {
        \App\Resource::response(\App\Resource::STATUS_NOT_FOUND);
    } else {
        $resource->put($id);
    }
});
// Delete
$app->delete('/api/v1/:resource/:id(/)', function($resource, $id = null) {
    $resource = \App\Resource::load($resource);
    if ($resource === null) {
        \App\Resource::response(\App\Resource::STATUS_NOT_FOUND);
    } else {
        $resource->delete($id);
    }
});
// Options
$app->options('/api/v1/:resource(/)', function($resource, $id = null) {
    $resource = \App\Resource::load($resource);
    if ($resource === null) {
        \App\Resource::response(\App\Resource::STATUS_NOT_FOUND);
    } else {
        $resource->options();
    }
});
// Not found
$app->notFound(function() {
    \App\Resource::response(\App\Resource::STATUS_NOT_FOUND);
});

$app->run();