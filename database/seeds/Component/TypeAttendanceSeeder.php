<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Present'],
            ['name' => 'Leave'],
            ['name' => 'Sick'],
            ['name' => 'Absent'],
            ['name' => 'present'],
        );

        /* Truncate all the data before populating*/
        if (DB::table('type_attendances')->get()->count() > 0) {
            DB::table('type_attendances')->truncate();
        }

        DB::table('type_attendances')->insert($data);
    }
}
