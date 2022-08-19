<?php

namespace App\Traits;

use App\Services\EmprestimoService;
use App\Services\ParcelaService;

trait ServiceTrait 
{
    public function parcelaService(): ParcelaService
    {
        return new ParcelaService();
    }

    public function emprestimoService(): EmprestimoService
    {
        return new EmprestimoService();
    }
}