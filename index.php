<?php

use DI\Container;
use SBL\Library\Database;
use Slim\Factory\AppFactory;
use Middlewares\TrailingSlash;

require_once __DIR__ . '/vendor/autoload.php';

session_start();

$container = new Container;

$container->set('database', new Database('slim', 'slim', 'slim'));

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->add(new TrailingSlash(false));

require_once __DIR__ . '/routes.php';

$app->run();
