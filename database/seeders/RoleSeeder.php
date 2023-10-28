<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //role seeder
        $roles = [
            ['role' =>  'admin'],
            ['role' => 'teacher'],
            ['role' => 'user'],
        ];
        DB::table('role')->insert($roles);
    }
}
