<?php

use DI\Container;
use SBL\Library\Database;
use Slim\Factory\AppFactory;
use Middlewares\TrailingSlash;

require_once __DIR__ . '/vendor/autoload.php';

session_start();

$config = parse_ini_file(__DIR__ . '/config.ini');

$container = new Container;

$container->set('database', new Database($config['DSN'], $config['USER'], $config['PASSWD']));

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->add(new TrailingSlash(false));

require_once __DIR__ . '/routes.php';

$app->run();
