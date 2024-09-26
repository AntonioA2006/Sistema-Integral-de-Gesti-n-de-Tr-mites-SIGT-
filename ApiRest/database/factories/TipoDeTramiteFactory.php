<?php

namespace Database\Factories;

use App\Models\TipoDeTramite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TipoDeTramiteFactory extends Factory
{

    protected $model = TipoDeTramite::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comments' =>  $this->faker->word,
            'name' =>  $this->faker->word


        ];
    }
}
