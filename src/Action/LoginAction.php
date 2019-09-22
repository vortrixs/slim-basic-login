<?php


namespace SBL\Action;

use SBL\Library\AbstractAction;
use SBL\Library\Crud;
use SBL\Model\UserModel;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class LoginAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, $args): Response
    {
        if (true === $this->isLoggedIn()) {
            return $response->withStatus(403)->withHeader('Location', '/');
        }

        $data = $request->getParsedBody();

        $user = new UserModel(
            new Crud(
                $this->container->get('database'),
                'users'
            )
        );

        $userData = $user->getUser($data['username'])->getData();

        if (false === $this->validate($userData, $data)) {
            $this->session->set(
                'sbl.user.login.msg',
                'Login failed. Username or password is incorrect, please try again.'
            );

            return $response->withStatus(302)->withHeader('Location', '/');
        }

        $this->session->set('sbl.user.current', base64_encode((serialize($userData))));
        $this->session->set('sbl.user.login.msg', "Login successful. Welcome {$userData['username']}!");

        return $response->withStatus(302)->withHeader('Location', '/');
    }

    private function validate(array $userData, array $requestData) : bool
    {
        if (null === $userData['id']) {
            return false;
        }

        if (false === password_verify($requestData['password'], $userData['password'])) {
            return false;
        }

        return true;
    }
}
