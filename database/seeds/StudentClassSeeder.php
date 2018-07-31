<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['school_group_id' => '1', 'name' => '1 (One)'],
            ['school_group_id' => '1', 'name' => '2 (Two)'],
            ['school_group_id' => '1', 'name' => '3 (Three)'],
            ['school_group_id' => '1', 'name' => '4 (Four)'],
            ['school_group_id' => '1', 'name' => '5 (Five)'],
            ['school_group_id' => '1', 'name' => '6 (Six)'],
            ['school_group_id' => '2', 'name' => '7 (Seven)'],
            ['school_group_id' => '2', 'name' => '8 (Eight)'],
            ['school_group_id' => '2', 'name' => '9 (Nine)'],
            ['school_group_id' => '3', 'name' => '10 (Ten)'],
            ['school_group_id' => '3', 'name' => '11 (Eleven)'],
            ['school_group_id' => '3', 'name' => '12 (Twelve)'],
            ['school_group_id' => '4', 'name' => '10 (Ten)'],
            ['school_group_id' => '4', 'name' => '11 (Eleven)'],
            ['school_group_id' => '4', 'name' => '12 (Twelve)'],
            ['school_group_id' => '5', 'name' => '10 (Ten)'],
            ['school_group_id' => '5', 'name' => '11 (Eleven)'],
            ['school_group_id' => '5', 'name' => '12 (Twelve)'],
            ['school_group_id' => '6', 'name' => '10 (Ten)'],
            ['school_group_id' => '6', 'name' => '11 (Eleven)'],
            ['school_group_id' => '6', 'name' => '12 (Twelve)'],
        );

        /* Truncate all the data before populating*/
        if (DB::table('student_classes')->get()->count() > 0) {
            DB::table('student_classes')->truncate();
        }

        DB::table('student_classes')->insert($data);
    }
}
