<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupQestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Registration student'],
            ['name' => 'Exercise student'],
            ['name' => 'Exam student'],
        );

        /* Truncate all the data before populating*/
        if (DB::table('group_questions')->get()->count() > 0) {
            DB::table('group_questions')->truncate();
        }

        DB::table('group_questions')->insert($data);
    }
}
