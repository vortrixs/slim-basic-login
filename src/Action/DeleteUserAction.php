<?php

namespace SBL\Action;

use App\Domain\User\User;
use SBL\Library\AbstractAction;
use SBL\Library\Crud;
use SBL\Library\Traits\LoginRequired;
use SBL\Model\UserModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class DeleteUserAction extends AbstractAction
{
    use LoginRequired;

    public function __invoke(Request $request, Response $response, $args): Response
    {
        if (false === $this->isLoggedIn()) {
            return $response->withStatus(403)->withHeader('Location', '/');
        }

        $model = new UserModel(
            new Crud(
                $this->container->get('database'),
                'users'
            )
        );

        $model->getUser($args['username'])->deleteUser();

        return $response->withStatus(302)->withHeader('Location', '/');
    }
}