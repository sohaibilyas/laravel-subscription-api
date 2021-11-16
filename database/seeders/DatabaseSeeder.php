<?php

namespace Database\Seeders;

use App\Models\Website;
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
        Website::factory()
            ->count(10)
            ->hasArticles(3)
            ->hasSubscribers(2)
            ->create();
    }
}
