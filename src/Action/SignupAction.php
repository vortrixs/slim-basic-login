<?php


namespace SBL\Action;

use SBL\Library\AbstractAction;
use SBL\View\SignupView;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class SignupAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write(
            $this->view(SignupView::class)->render('signup')
        );

        return $response;
    }
}
