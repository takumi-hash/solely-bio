<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Takumi Hashimoto',
            'handlename' => 'takumi-hashimoto',
            'email' => 'test@example.com',
            'imageUrl' => 'images/default.webp',
            'password' => bcrypt('testpass'),
        ]);
        $this->call([LinksSeeder::class]);
    }
}
