<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\EmploymentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'salary' => $this->faker->numberBetween(100000,500000),
            'category_id' => Category::get()->random()->id,
            'employment_type_id' => EmploymentType::get()->random()->id,
            'responsibility' => $this->faker->text(),
            'requirements' => $this->faker->text(),
        ];
    }
}
