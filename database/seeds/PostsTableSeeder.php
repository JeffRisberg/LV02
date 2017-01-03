<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert(['title' => 'T1', 'description' => 'D1']);
        DB::table('posts')->insert(['title' => 'T2', 'description' => 'D2']);
        DB::table('posts')->insert(['title' => 'T3', 'description' => 'D3']);
    }
}
