<?php

namespace Database\Factories;

use App\Models\UserManagement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserManagementFactory  extends Factory
{
    protected $model = UserManagement::class;

    /**
     * The current password being used by the factory.
     */

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $curp = $this->faker->regexify('[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}');
        return [
            'name' => fake()->name(),
            'curp' =>$curp,
           'last_name' => $this->faker->lastName,
           'first_name' => $this->faker->firstName,
           'birthdate' => $this->faker->date('Y-m-d', '-18 years'),
           'state' => $this->faker->state,
           'city' => $this->faker->city,
            'section_id' => $this->faker->numberBetween(2, 20),
            'password' => Hash::make($curp),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
     public function unverified(): static
     {
         return $this->state(fn (array $attributes) => [
             'email_verified_at' => null,
        ]);
     }
}
