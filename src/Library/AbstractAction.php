<?php

namespace SBL\Library;

use Psr\Container\ContainerInterface;
use SBL\Library\Traits\LoginRequired;
use SBL\Library\Traits\Permissions;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

abstract class AbstractAction
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var SessionHelper
     */
    protected $session;

    use LoginRequired;
    use Permissions;

    /**
     * AbstractAction constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->session = new SessionHelper;
    }

    /**
     * @param string $view
     *
     * @return AbstractView
     */
    protected function view(string $view) : AbstractView
    {
        if (false === class_exists($view)) {
            throw new \RuntimeException("View {$view} doesn't exist.");
        }

        return new $view;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    abstract public function __invoke(Request $request, Response $response, array $args) : Response;
}
