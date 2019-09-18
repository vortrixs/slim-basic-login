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
        $data = $request->getParsedBody();

        $user = (new UserModel(new Crud($this->container->get('database'), 'users')))
            ->getUser($data['username'], $data['password'])->getData();

        if (null === $user['id']) {
            $this->session->set(
                'sbl.user.login.msg',
                'Login failed. Username or password is incorrect, please try again.'
            );

            return $response->withStatus(302)->withHeader('Location', '/');
        }

        $this->session->set('sbl.user.current', base64_encode((serialize($user))));
        $this->session->set('sbl.user.login.msg', "Login successful. Welcome {$user['username']}!");

        return $response->withStatus(302)->withHeader('Location', '/');
    }
}
