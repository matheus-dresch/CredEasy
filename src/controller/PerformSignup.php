<?php

namespace Sicredi\Credeasy\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sicredi\Credeasy\Entity\Cliente;
use Sicredi\Credeasy\Helper\FlashMessageTrait;
use Sicredi\Credeasy\Repository\ClienteRepository;

//todo muitas coisa

class PerformSignup implements RequestHandlerInterface
{

    use FlashMessageTrait;

    /** @var ClienteRepository $em */
    private $clienteRepo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->clienteRepo = $em->getRepository(Cliente::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $post = $request->getParsedBody();
        
        $filteredPost = filter_input(INPUT_POST, FILTER_SANITIZE_STRING); 

        foreach ($filteredPost as $key => $value) {
            if (is_null($value)) {
                $this->defMessage("danger", "O campo $key é inválido");
                return new Response(200, ['location' => '/signup']);
                exit();
            }
        }

        [
            'nome' => $nome,
            'cpf' => $cpf,
            'numero' => $numero,
            'profissao' => $profissao,
            'renda' => $renda,
            'email' => $email,

            'cep' => $cep,
            'estado' => $estado,
            'cidade' => $cidade,
            'bairro' => $bairro,
            'rua' => $rua,
            'numcasa' => $numcasa,

            'senha' => $senha
        ] = $filteredPost;



        return new Response(300, [], var_dump($filteredPost));
    }
}