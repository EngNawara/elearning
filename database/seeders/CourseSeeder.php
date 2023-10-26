<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //course seeder
        $courses = [
            [
                'name'=>'Python',
                'code'=>'course1',
                'description'=>'this course for python',
                'summary'=>'summary for python',
                'requirement'=>'html , css',
                'price'=>100,
                'teacher_id'=>1,
                'category_id'=>1,
                'started_at'=>now(),
                'finished_at'=>now(),
                'duration'=>'30 days',
                'status'=>'enabled',
                'image'=>'path',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'name'=>'english',
                'code'=>'course2',
                'description'=>'learn english description',
                'summary'=>'learn english summary',
                'requirement'=>'A1 ',
                'price'=>100,
                'teacher_id'=>1,
                'category_id'=>2,
                'started_at'=>now(),
                'finished_at'=>now(),
                'duration'=>'30 days',
                'status'=>'enabled',
                'image'=>'path',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ];
        DB::table('courses')->insert($courses);
    }
}
