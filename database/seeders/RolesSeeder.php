<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'Administrador'],
            ['id' => 2, 'nombre' => 'Garzón'],
            ['id' => 3, 'nombre' => 'Caja'],
            ['id' => 4, 'nombre' => 'Cocina'],
        ]);
    }
}
