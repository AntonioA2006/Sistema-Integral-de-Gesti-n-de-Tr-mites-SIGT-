<?php

namespace Database\Factories;

use App\Models\Tramite;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TramiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Tramite::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'tipo_de_tramite_id' => $this->faker->numberBetween(1, 40)
        ];
    }
}
