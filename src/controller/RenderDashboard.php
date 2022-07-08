<?php

namespace Sicredi\Credeasy\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sicredi\Credeasy\Entity\Cliente;
use Sicredi\Credeasy\Entity\Emprestimo;
use Sicredi\Credeasy\Entity\Parcela;
use Sicredi\Credeasy\Helper\RenderHtmlTrait;

class RenderDashboard implements RequestHandlerInterface
{

    use RenderHtmlTrait;

    private $em;
    private $empRepo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->empRepo = $em->getRepository(Emprestimo::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** 
         * @var Cliente $cliente 
         */
        $cliente = $this->em->find(Cliente::class, $_SESSION['cpf']);

        extract($this->sumTotais($cliente));

        $emprestimos = $cliente->getEmprestimos();
        $ultimoEmprestimo = $emprestimos->last();

        $qtdEmprestimos = $cliente->getEmprestimos()->count();
        $nome = $cliente->getNome();

        $html = $this->renderHtml('cliente/dashboard.php', [
            'emprestimos' => $emprestimos,
            'ultimoEmprestimo' => $ultimoEmprestimo,
            'qtdEmprestimos' => $qtdEmprestimos,
            'totalPago' => $totalPago,
            'totalEmprestado' => $totalEmprestado,
            'nome' => $nome,
        ]);

        return new Response(200, [], $html);
    }

    private function sumTotais(Cliente $cliente): array
    {
        /**
         * @var Emprestimo[] $emprestimos
         */
        $emprestimos = $cliente->getEmprestimos();

        $totais = [
            'totalEmprestado' => 0,
            'totalPago' => 0
        ];

        foreach ($emprestimos as $emprestimo) {
            if ($emprestimo->getStatus() === 'APROVADO') {
                $totais['totalEmprestado'] += $emprestimo->getValor();

                /** @var Parcela[] $parcelas */
                $parcelas = $emprestimo->getParcelas();

                foreach ($parcelas as $parcela) {
                    if ($parcela->getStatus() === 'PAGA') {
                        $totais['totalPago'] += $parcela->getValor();
                    }
                }
            }
        }

        return $totais;
    }
}
