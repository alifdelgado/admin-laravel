<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();
        User::factory()->create([
            'first_name'    =>  'admin',
            'last_name'     =>  'admin',
            'email'         =>  'admin@admin.com',
            'role_id'       =>  1
        ]);
        User::factory()->create([
            'first_name'    =>  'editor',
            'last_name'     =>  'editor',
            'email'         =>  'editor@editor.com',
            'role_id'       =>  2
        ]);
        User::factory()->create([
            'first_name'    =>  'viewer',
            'last_name'     =>  'viewer',
            'email'         =>  'viewer@viewer.com',
            'role_id'       =>  3
        ]);
    }
}
