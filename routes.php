<?php

use SBL\Action\ChangeAdminAccessAction;
use SBL\Action\ChangePasswordAction;
use SBL\Action\DeleteUserAction;
use SBL\Action\HomeAction;
use SBL\Action\LoginAction;
use SBL\Action\LogoutAction;
use SBL\Action\RegisterUserAction;
use SBL\Action\SignupAction;
use Slim\Routing\RouteCollectorProxy;

$app->get('/', HomeAction::class);

$app->post('/login', LoginAction::class);

$app->post('/logout', LogoutAction::class);

$app->get('/signup', SignupAction::class);

$app->post('/signup', RegisterUserAction::class);

$app->group('/user/{username}', function (RouteCollectorProxy $group) {

    $group->map(['GET', 'POST'], '/changepassword', ChangePasswordAction::class);

    $group->post('/changeaccess', ChangeAdminAccessAction::class);

    $group->post('/delete', DeleteUserAction::class);
});
