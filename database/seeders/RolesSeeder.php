<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            'role' => 'admin'
        ]);
        Roles::create([
            'role' => 'client'
        ]);
        $this->command->info('Roles has been created!.');
    }
}
