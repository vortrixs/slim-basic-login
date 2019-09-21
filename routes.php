<?php

use SBL\Action\ChangePasswordAction;
use SBL\Action\HomeAction;
use SBL\Action\LoginAction;
use SBL\Action\LogoutAction;
use SBL\Action\RegisterUserAction;
use SBL\Action\SignupAction;

$app->get('/', HomeAction::class);

$app->post('/login', LoginAction::class);

$app->post('/logout', LogoutAction::class);

$app->get('/signup', SignupAction::class);

$app->post('/signup', RegisterUserAction::class);

$app->get('/user/{username}/changepassword', ChangePasswordAction::class);

$app->post('/user/{username}/changepassword', ChangePasswordAction::class);

