<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'view_user'],
            ['name' => 'edit_user'],
            ['name' => 'view_role'],
            ['name' => 'edit_role'],
            ['name' => 'view_product'],
            ['name' => 'edit_product'],
            ['name' => 'view_order'],
            ['name' => 'edit_order'],
        ]);
    }
}
