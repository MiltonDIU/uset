<?php

namespace Modules\Academic\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Academic\Models\AdmissionRequirement;

class AdmissionRequirementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = AdmissionRequirement::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
