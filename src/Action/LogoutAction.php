<?php

namespace SBL\Action;

use SBL\Library\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LogoutAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, $args): Response
    {
        $this->session->delete('sbl.user.current');

        return $response->withStatus(302)->withHeader('Location', '/');
    }
}
