<?php

namespace SBL\Action;

use SBL\Library\AbstractAction;
use SBL\View\HomeView;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class HomeAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, $args) : Response
    {
        $templateData = [
            'session' => $this->session,
        ];

        $response->getBody()->write(
            $this->view(HomeView::class)->render('home', $templateData)
        );

        return $response;
    }
}
