<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{

    public function withFaker()
    {
        return \Faker\Factory::create('pt_BR');
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $fake = fake('pt-BR');

        return [
            'cpf' => $this->faker->cpf(),
            'nome' => $this->faker->name(),
            'telefone' => $this->faker->phoneNumber(),
            'endereco' => $this->faker->address(),
            'profissao' => $this->faker->jobTitle(),
            'renda' => $this->faker->randomFloat(2, 1200, 10000),
            'email' => $this->faker->email(),
            'senha' => password_hash('123456', PASSWORD_ARGON2I),
            'tipo' => 'CLIENTE'
        ];
    }
}
