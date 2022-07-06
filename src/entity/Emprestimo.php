<?php

namespace Sicredi\Credeasy\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Emprestimo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $nome_emprestimo;
    
    /**
     * @ORM\Column(type="decimal", scale=2, precision=10)
     */
    private float $valor;
    
    /**
     * @ORM\Column(type="decimal", scale=2, precision=10)
     */
    private float $taxa_juros;
   
    /**
     * @ORM\Column(type="decimal", scale=2, precision=10, nullable=true)
     */
    private float $valor_final;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $data_solicitacao;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $data_quitacao;

    /**
     * @ORM\Column(type="string", options={"default":"SOLICITADO"})
     */
    private string $status;

    /**
     * @ORM\ManyToOne(targetEntity="Cliente", fetch="EAGER")
     * @ORM\JoinColumn(name="cliente_cpf", referencedColumnName="cpf")
     */
    private Cliente $cliente;

    /**
     * @ORM\OneToMany(targetEntity="Parcela", fetch="EAGER", mappedBy="emprestimo", cascade={"persist", "remove"})
     */
    private $parcelas;

    public function __construct(
		string $nome_emprestimo,
		float $valor,
		float $taxa_juros,
		DateTimeInterface $dataSolicitacao
	)
    {
		$this->nome_emprestimo = $nome_emprestimo;
		$this->valor = $valor;
		$this->taxa_juros = $taxa_juros;
		$this->data_solicitacao = $dataSolicitacao;
		$this->status = "SOLICITADO";

        $this->parcelas = new ArrayCollection();
		
    }

	public function getId(): int
	{
		return $this->id;
	}

	public function getNomeEmprestimo(): string
	{
		return $this->nome_emprestimo;
	}

	public function setNomeEmprestimo(string $nome_emprestimo)
	{
		$this->nome_emprestimo = $nome_emprestimo;
	}

	public function getValor(): float
	{
		return $this->valor;
	}

	public function setValor(float $valor)
	{
		$this->valor = $valor;
	}

	public function getTaxaJuros(): float
	{
		return $this->taxa_juros;
	}

	public function setTaxaJuros(float $taxa_juros)
	{
		$this->taxa_juros = $taxa_juros;
	}

	public function getValorFinal(): float
	{
		return $this->valor_final;
	}

	public function setValorFinal(float $valor_final)
	{
		$this->valor_final = $valor_final;
	}

	public function getDataSolicitacao(): DateTime
	{
		return $this->data_solicitacao;
	}

	public function setDataSolicitacao($data_solicitacao)
	{
		$this->data_solicitacao = $data_solicitacao;
	}

	public function getDataQuitacao(): DateTime
	{
		return $this->data_quitacao;
	}

	public function setDataQuitacao($data_quitacao)
	{
		$this->data_quitacao = $data_quitacao;
	}

	public function getStatus(): string
	{
		return $this->status;
	}

	public function setStatus(string $status)
	{
		$this->status = $status;
	}

	public function getCliente(): Cliente
	{
		return $this->cliente;
	}

	public function getParcelas(): Collection
	{
		return $this->parcelas;
	}

    public function addParcela(Parcela $parcela): self
    {
        $this->parcelas->add($parcela);
		$parcela->setEmprestimo($this);
		
        return $this;
    }

	public function setCliente(Cliente $cliente)
	{
		$this->cliente = $cliente;
	}
}