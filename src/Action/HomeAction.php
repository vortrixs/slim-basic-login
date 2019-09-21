<?php

namespace SBL\Action;

use SBL\Library\AbstractAction;
use SBL\Library\Crud;
use SBL\Model\UserModel;
use SBL\View\HomeView;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class HomeAction extends AbstractAction
{
    public function __invoke(Request $request, Response $response, $args) : Response
    {
        $user = null;

        if (true === $this->session->exists('sbl.user.current')) {
            $user = unserialize(base64_decode($this->session->get('sbl.user.current')));
        }

        $templateData = [
            'session' => $this->session,
            'user'    => $user,
        ];

        if (null !== $user) {
            $templateData['users'] = $this->getUsersCollection();
        }

        $response->getBody()->write(
            $this->view(HomeView::class)->render('home', $templateData)
        );

        return $response;
    }

    private function getUsersCollection()
    {
        return (new UserModel(new Crud($this->container->get('database'), 'users')))->getAll();
    }
}
