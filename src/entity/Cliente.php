<?php

namespace Sicredi\Credeasy\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Cliente
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="string", length=14)
	 */
	private string $cpf;

	/**
	 * @ORM\Column(type="string")
	 */
	private string $nome;

	/**
	 * @ORM\Column(type="string", length=20)
	 */
	private string $numero;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private string $endereco;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private string $profissao;

	/**
	 * @ORM\Column(type="decimal", scale=2, precision=9)
	 */
	private float $renda;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private string $email;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private string $senha;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private string $tipo_usuario;

	/**
	 * @ORM\OneToMany(targetEntity="Emprestimo", mappedBy="cliente", cascade={"persist", "remove"})
	 */
	private $emprestimos;

	/**
	 * @ORM\Column(type="decimal", precision="10", scale="2")
	 */
	private float $total_emprestado = 0;

	/**
	 * @ORM\Column(type="integer")
	 */
	private int $qtd_emprestimos = 0;

	public function __construct(
		string $cpf,
		string $nome,
		string $numero,
		string $endereco,
		string $profissao,
		float $renda,
		string $email,
		string $senha,
		string $tipoUsuario = "USUARIO"
	) {
		$this->cpf = $cpf;
		$this->nome = $nome;
		$this->numero = $numero;
		$this->endereco = $endereco;
		$this->profissao = $profissao;
		$this->renda = $renda;
		$this->email = $email;
		$this->senha = $senha;
		$this->tipo_usuario = $tipoUsuario;

		$this->emprestimos = new ArrayCollection();
	}

	public function getCpf(): string
	{
		return $this->cpf;
	}

	public function getNumero(): string
	{
		return $this->numero;
	}

	public function setNumero(string $numero)
	{
		$this->numero = $numero;
	}

	public function getEndereco(): string
	{
		return $this->endereco;
	}

	public function setEndereco(string $endereco)
	{
		$this->endereco = $endereco;
	}

	public function getProfissao(): string
	{
		return $this->profissao;
	}

	public function setProfissao(string $profissao)
	{
		$this->profissao = $profissao;
	}

	public function getRenda(): float
	{
		return $this->renda;
	}

	public function setRenda(float $renda)
	{
		$this->renda = $renda;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function setEmail(string $email)
	{
		$this->email = $email;
	}

	public function getSenha(): string
	{
		return $this->senha;
	}

	public function setSenha(string $senha)
	{
		$this->senha = $senha;
	}

	public function getTipoUsuario(): string
	{
		return $this->tipo_usuario;
	}

	public function setTipoUsuario(string $tipo_usuario)
	{
		$this->tipo_usuario = $tipo_usuario;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getEmprestimos(): Collection
	{
		return $this->emprestimos;
	}

	public function addEmprestimo(Emprestimo $emprestimo): self
	{
		$emprestimo->setCliente($this);
		$this->emprestimos->add($emprestimo);

		return $this;
	}

	public function getNome(): string
	{
		return $this->nome;
	}

	public function setNome(string $nome)
	{
		$this->nome = $nome;
	}

	public function getTotalEmprestado(): float
	{
		return $this->total_emprestado;
	}

	public function getQtdEmprestimos(): int
	{
		return $this->qtd_emprestimos;
	}

	public function addQtdEmprestimos()
	{
		$this->qtd_emprestimos++;
	}

	public function addTotalEmprestado(float $valor)
	{
		$this->total_emprestado += $valor;
	}
        }
