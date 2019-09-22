<?php


namespace SBL\Action;

use SBL\Library\AbstractAction;
use SBL\View\SignupView;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class SignupAction extends AbstractAction
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (true === $this->isLoggedIn()) {
            return $response->withStatus(403)->withHeader('Location', '/');
        }

        $response->getBody()->write(
            $this->view(SignupView::class)->render('signup')
        );

        return $response;
    }
}
