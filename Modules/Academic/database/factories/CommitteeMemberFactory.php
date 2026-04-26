<?php

namespace Modules\Academic\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Academic\Models\CommitteeMember;

class CommitteeMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = CommitteeMember::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}
