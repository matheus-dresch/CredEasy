<?php

namespace App\Traits;

trait ApiResponse
{
    protected function respostaSucesso($data, $message = '', $code = 200)
    {
        return response()->json([
            'status' => 'Sucesso',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function respostaErro($message, $code)
    {
        return response()->json([
            'status' => 'Erro',
            'message' => $message,
            'data' => null
        ], $code);
    }
}