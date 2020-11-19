<?php

namespace Database\Factories;

use App\Enum\ActivityTypeEnum;
use App\Models\Activity;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'activity_type' => $this->faker->randomElement([ActivityTypeEnum::CYCLING(),ActivityTypeEnum::SWIMMING(),ActivityTypeEnum::WALKING()]),
            'kilometers' => $this->faker->randomFloat(2, 0, 99999999.99),
            'published_at' => $this->faker->dateTime(),
        ];
    }
}
