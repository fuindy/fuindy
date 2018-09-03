<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Senior'],
            ['name' => 'Junior'],
            ['name' => 'Pension'],
            ['name' => 'Leave'],
            ['name' => 'Honorarium'],
            ['name' => 'Resign'],
        );

        /* Truncate all the data before populating*/
        if (DB::table('status_teachers')->get()->count() > 0) {
            DB::table('status_teachers')->truncate();
        }

        DB::table('status_teachers')->insert($data);
    }
}
