<?php

use SBL\Action\HomeAction;
use SBL\Action\RegisterUserAction;
use SBL\Action\SignupAction;

$app->get('/', HomeAction::class);

$app->get('/signup', SignupAction::class);

$app->post('/signup', RegisterUserAction::class);

