<?php

use Sicredi\Credeasy\Controller\PerformLogin;
use Sicredi\Credeasy\Controller\PerformLogout;
use Sicredi\Credeasy\Controller\PerformSignup;
use Sicredi\Credeasy\Controller\RenderDashboard;
use Sicredi\Credeasy\Controller\RenderHome;
use Sicredi\Credeasy\Controller\RenderLogin;
use Sicredi\Credeasy\Controller\RenderNovoEmprestimo;
use Sicredi\Credeasy\Controller\RenderSignup;

return [
    '/home' => RenderHome::class,
    '/login' => RenderLogin::class,
    '/signup' => RenderSignup::class,
    '/dashboard' => RenderDashboard::class,
    '/novo-emprestimo' => RenderNovoEmprestimo::class,

    '/do-signup' => PerformSignup::class,
    '/do-login' => PerformLogin::class,
    '/do-logout' => PerformLogout::class
];