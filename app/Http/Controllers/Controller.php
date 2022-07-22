<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    private $cliente;

    public function __construct(Guard $auth)
    {
        $this->cliente = $auth->user();
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
