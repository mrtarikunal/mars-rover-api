<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('plateaus')->insert(['x' => 80, 'y' => 60]);
        DB::table('rovers')->insert(['plateau_id' => 1, 'x' => 60, 'y' => 40, 'heading' => 'N']);
    }
}
