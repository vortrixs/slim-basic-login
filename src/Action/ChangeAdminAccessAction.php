<?php


namespace SBL\Action;

use SBL\Library\AbstractAction;
use SBL\Library\Crud;
use SBL\Model\UserModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ChangeAdminAccessAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, $args) : Response
    {
        if (false === $this->isLoggedIn()) {
            return $response->withStatus(403)->withHeader('Location', '/');
        }

        $data = $request->getParsedBody();

        $model = new UserModel(
            new Crud(
                $this->container->get('database'),
                'users'
            )
        );

        $model->getUser($args['username'])->changeAdminAccess((int) $data['access']);

        return $response->withStatus(302)->withHeader('Location', '/');
    }
}
