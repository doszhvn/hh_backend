<?php

namespace Database\Factories;

use App\Models\CV;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VacancyReply>
 */
class VacancyReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cv_id' => CV::get()->random()->id,
            'vacancy_id' => Vacancy::get()->random()->id,
            'covering_letter' => $this->faker->words(),
        ];
    }
}
