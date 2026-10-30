<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    \App\Models\User::create([
        'name'     => 'Admin Berita',
        'email'    => 'admin@gmail.com',
        'password' => \Illuminate\Support\Facades\Hash::make('password123'),
    ]);
    }
}
