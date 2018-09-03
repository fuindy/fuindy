<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusQuestionTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Upload'],
            ['name' => 'Finish'],
            ['name' => 'Read']
        );

        /* Truncate all the data before populating*/
        if (DB::table('status_question_tests')->count() > 0) {
            DB::table('status_question_tests')->truncate();
        }

        DB::table('status_question_tests')->insert($data);
    }
}
