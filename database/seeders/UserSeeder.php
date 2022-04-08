<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seederAdmin();
        User::factory()->count(10)->create();
    }

    public function seederAdmin()
    {
        User::create([
            'first_name' => 'Thai',
            'last_name' => 'Tan',
            'user_name' => 'thaitan1807',
            'isAdmin' => 1,
            'isActive' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
