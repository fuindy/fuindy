<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupParticipantQuestionTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Group A'],
            ['name' => 'Group B'],
            ['name' => 'Group C'],
            ['name' => 'Group D'],
            ['name' => 'Group E'],
            ['name' => 'Group F'],
            ['name' => 'Group G'],
        );

        /* Truncate all the data before populating*/
        if (DB::table('group_participant_question_tests')->get()->count() > 0) {
            DB::table('group_participant_question_tests')->truncate();
        }

        DB::table('group_participant_question_tests')->insert($data);
    }
}
