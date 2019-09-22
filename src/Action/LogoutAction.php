<?php

namespace SBL\Action;

use SBL\Library\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LogoutAction extends AbstractAction
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
        $this->session->delete('sbl.user.current');

        return $response->withStatus(302)->withHeader('Location', '/');
    }
}
