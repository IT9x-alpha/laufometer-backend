<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Activity;
use App\Models\Group;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'group_id' => Group::factory(),
            'name' => $this->faker->name,
            'activity_type' => $this->faker->word,
            'kilometers' => $this->faker->randomFloat(2, 0, 99999999.99),
            'published_at' => $this->faker->dateTime(),
        ];
    }
}
