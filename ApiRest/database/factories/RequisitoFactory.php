<?php

namespace Database\Factories;

use App\Models\Requisito;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RequisitoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Requisito::class;


    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'tipo_de_tramites_id' => $this->faker->numberBetween(1, 40)
        ];
    }
}
