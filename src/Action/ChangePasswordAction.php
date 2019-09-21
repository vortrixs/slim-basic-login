<?php

namespace SBL\Action;

use SBL\Library\AbstractAction;
use SBL\Library\Crud;
use SBL\Library\Traits\LoginRequired;
use SBL\Model\UserModel;
use SBL\View\ChangePasswordView;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ChangePasswordAction extends AbstractAction
{
    use LoginRequired;

    public function __invoke(Request $request, Response $response, $args): Response
    {
        if (false === $this->isLoggedIn()) {
            return $response->withStatus(403)->withHeader('Location', '/');
        }

        if ('GET' === $request->getMethod()) {
            $response = $this->get($response, $args);
        } elseif ('POST' === $request->getMethod()) {
            $response = $this->post($request, $response, $args);
        }

        return $response;
    }

    private function get(Response $response, array $args) : Response
    {
        $response->getBody()->write(
            $this->view(ChangePasswordView::class)
                ->render('changepassword', array_merge($args, ['session' => $this->session]))
        );

        return $response;
    }

    private function post(Request $request, Response $response, array $args) : Response
    {
        $data = $request->getParsedBody();

        if ($data['password'] !== $data['password2']) {
            $this->session->set('sbl.user.update.failed', 'Password and Repeat password must match each other.');

            return $response->withStatus(302)->withHeader('Location', "/user/{$args['username']}/changepassword");
        }

        $model = new UserModel(new Crud($this->container->get('database'), 'users'));

        if (0 === $model->getUser($args['username'])->changePassword($data['password'])) {
            $this->session->set(
                'sbl.user.update.failed',
                'Password could not be changed, try again or contact an administrator'
            );

            return $response->withStatus(302)->withHeader('Location', "/user/{$args['username']}/changepassword");
        }

        $this->session->set(
            'sbl.user.update.success',
            "The password for {$args['username']} was successfully changed."
        );

        return $response->withStatus(302)->withHeader('Location', '/');
    }
}
