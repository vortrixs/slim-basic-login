<?php


namespace SBL\Action;

use SBL\Library\AbstractAction;
use SBL\Library\Crud;
use SBL\Library\SessionHelper;
use SBL\Library\Traits\LoginRequired;
use SBL\Model\UserModel;
use SBL\View\SignupView;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class RegisterUserAction extends AbstractAction
{
    use LoginRequired;

    private $error = [];

    public function __invoke(Request $request, Response $response, $args): Response
    {
        if (true === $this->isLoggedIn()) {
            return $response->withStatus(403)->withHeader('Location', '/');
        }

        $data = $request->getParsedBody();

        if (false === $this->validate($data)) {
            $response->getBody()->write(
                $this->view(SignupView::class)->render('signup', $this->error)
            );

            return $response;
        }

        $user = $this->createUser(
            new UserModel(
                new Crud(
                    $this->container->get('database'),
                    'users'
                )
            ),
            $data
        );

        if (false === $user) {
            $this->error = ['username' => "A user with the name {$data['username']} already exists."];

            $response->getBody()->write(
                $this->view(SignupView::class)->render('signup', $this->error)
            );

            return $response;
        }

        $userData = $user->getData();

        (new SessionHelper)->set('sbl.user.created', "User {$userData['username']} was successfully created.");

        return $response->withStatus(302)->withHeader('Location', '/');
    }

    private function validate(array $data = []) : bool
    {
        if (empty($data['username'])) {
            $this->error['username'] = 'Username is required.';
        }

        if (empty($data['password'])) {
            $this->error['password'] = 'Password is required.';
        }

        if ($data['password'] !== $data['password2']) {
            $this->error['password2'] = 'Password and Repeat password must match each other.';
        }

        return empty($this->error);
    }

    private function createUser(UserModel $model, array $data)
    {
        return $model->createUser($data['username'], $data['password']);
    }
}
