<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Activity::factory()->count(5)->create();
        Group::factory()->count(5)->create();
        User::factory()->count(5)->create();
    }
}
