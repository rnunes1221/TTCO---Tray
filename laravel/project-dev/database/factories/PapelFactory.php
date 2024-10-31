<?php

namespace Database\Factories;
use App\Models\Papel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Papel>
 */
class PapelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Papel::class;
    public function definition(): array
    {
        return [
            "nome" => $this->faker->name,
            "gestor" => 'Y'
        ];
    }
}
