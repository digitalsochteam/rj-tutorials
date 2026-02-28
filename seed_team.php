<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Clear existing
DB::table('team_members')->truncate();

// Seed the 2 original hardcoded members
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

$members = DB::table('team_members')->get();
foreach ($members as $m) {
    echo "ID:{$m->id} | {$m->name} | {$m->designation}" . PHP_EOL;
}
echo "Done! " . count($members) . " members seeded." . PHP_EOL;
