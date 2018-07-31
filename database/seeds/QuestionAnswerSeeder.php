<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'answer_a'],
            ['name' => 'answer_b'],
            ['name' => 'answer_c'],
            ['name' => 'answer_d'],
            ['name' => 'answer_e'],
        );

        /* Truncate all the data before populating*/
        if (DB::table('question_answers')->get()->count() > 0) {
            DB::table('question_answers')->truncate();
        }

        DB::table('question_answers')->insert($data);
    }
}
