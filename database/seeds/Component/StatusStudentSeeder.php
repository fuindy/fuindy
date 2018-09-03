<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'student'],
            ['name' => 'alumni'],
            ['name' => 'Suspend'],
            ['name' => 'Apprenticeship'],
            ['name' => 'DO'],
        );

        /* Truncate all the data before populating*/
        if (DB::table('status_students')->get()->count() > 0) {
            DB::table('status_students')->truncate();
        }

        DB::table('status_students')->insert($data);
    }
}
