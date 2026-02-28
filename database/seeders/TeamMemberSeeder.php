<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('team_members')->truncate();

        DB::table('team_members')->insert([
            [
                'name'        => 'Prof. Dr. Rohit K Jain',
                'designation' => 'Founder, RJ Tutorials',
                'photo'       => null,
                'sort_order'  => 1,
                'is_active'   => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Neelima R Jain',
                'designation' => 'Director, RJ Tutorials',
                'photo'       => null,
                'sort_order'  => 2,
                'is_active'   => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
