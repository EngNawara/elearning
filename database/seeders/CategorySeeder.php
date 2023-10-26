<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //categories seeder
        $categories = [
            [
                'name'=>'programing',
                'status'=>'enable',
                'image'=>'path',
            ],
            [
                'name'=>'learn en',
                'status'=>'enable',
                'image'=>'path',
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
