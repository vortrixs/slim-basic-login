<?php

namespace SBL\Library;

use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

abstract class AbstractAction
{
    protected $container;

    protected $session;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->session = new SessionHelper;
    }

    protected function view(string $view) : AbstractView
    {
        if (false === class_exists($view)) {
            throw new \RuntimeException("View {$view} doesn't exist.");
        }

        return new $view;
    }

    abstract public function __invoke(Request $request, Response $response, $args) : Response;
}
