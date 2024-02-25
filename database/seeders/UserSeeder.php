<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        $user1 = new User();
        $user1->name = 'Max Muster';
        $user1->email = 'max.muster@example.org';
        $user1->password = bcrypt('geheim');
        $user1->save();
        */

        User::factory(5)->create();
    }
}
