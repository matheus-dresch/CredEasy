<?php

use Sicredi\Credeasy\Controller\PerformSignup;
use Sicredi\Credeasy\Controller\RenderHome;
use Sicredi\Credeasy\Controller\RenderLogin;
use Sicredi\Credeasy\Controller\RenderSignup;

return [
    '/home' => RenderHome::class,
    '/login' => RenderLogin::class,
    '/signup' => RenderSignup::class,
    '/create-cliente' => PerformSignup::class
];