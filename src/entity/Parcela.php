<?php

namespace Sicredi\Credeasy\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Parcela
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private float $valor;

    /**
     * @ORM\Column(type="integer")
     */
    private int $numero;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data_vencimento;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $data_pagamento;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private float $multa;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private float $valor_pago;

    /**
     * @ORM\Column(type="string", options={"default": "ABERTA"})
     */
    private string $status;

    /**
     * @ORM\ManyToOne(targetEntity="Emprestimo", cascade={"persist", "remove"})
     */
    private Emprestimo $emprestimo;

    public function __construct(Emprestimo $emprestimo, float $valor, int $numero, $data_vencimento)
    {
        $this->emprestimo = $emprestimo;
        $this->valor = $valor;
        $this->numero = $numero;
        $this->data_vencimento = $data_vencimento;
		$this->status = 'ABERTA';
    }

	public function getId(): int
	{
		return $this->id;
	}

	public function getValor(): float
	{
		return $this->valor;
	}

	public function setValor(float $valor)
	{
		$this->valor = $valor;
	}

	public function getNumero(): int
	{
		return $this->numero;
	}

	public function getDataVencimento()
	{
		return $this->data_vencimento;
	}

	public function setDataVencimento($data_vencimento)
	{
		$this->data_vencimento = $data_vencimento;
	}

	public function getDataPagamento()
	{
		return $this->data_pagamento;
	}

	public function setDataPagamento($data_pagamento)
	{
		$this->data_pagamento = $data_pagamento;
	}

	public function getMulta(): float
	{
		return $this->multa;
	}

	public function setMulta(float $multa)
	{
		$this->multa = $multa;
	}

	public function getValorPago(): float
	{
		return $this->valor_pago;
	}

	public function setValorPago(float $valor_pago)
	{
		$this->valor_pago = $valor_pago;
	}

	public function getStatus(): string
	{
		return $this->status;
	}

	public function setStatus(string $status)
	{
		$this->status = $status;
	}

	public function getEmprestimo(): Emprestimo
	{
		return $this->emprestimo;
	}

	public function setEmprestimo(Emprestimo $emprestimo)
	{
		$this->emprestimo = $emprestimo;
	}
}