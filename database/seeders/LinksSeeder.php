<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert([
            'id' => 1,
            'title' => 'GitHub',
            'url' => 'https://github.com/takumi-hash',
            'user_id' => 1,
            'created_at' => now(),
        ]);
        DB::table('links')->insert([
            'id' => 2,
            'title' => 'Podcast',
            'url' => 'https://anchor.fm/futakobookcast',
            'user_id' => 1,
            'created_at' => now(),
        ]);
        DB::table('links')->insert([
            'id' => 3,
            'title' => 'Book Club',
            'url' => 'https://instagram.com/futako_book_club',
            'user_id' => 1,
            'created_at' => now(),
        ]);
    }
}
