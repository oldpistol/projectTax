<?php

namespace Database\Factories;

use App\Models\ReliefType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->realText(),
            'amount' => $this->faker->randomFloat(2, 100, 3000),
            'filename' => Str::random(16) . '.' . $this->faker->fileExtension(),
            'user_id' => User::factory(),
            'relief_type_id' => ReliefType::factory()
        ];
    }
}
