<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Processed'],
            ['name' => 'Be read'],
            ['name' => 'Not complete'],
            ['name' => 'Complete'],
            ['name' => 'Be accepted'],
            ['name' => 'Not accepted'],
        );

        /* Truncate all the data before populating*/
        if (DB::table('status_registrations')->get()->count() > 0) {
            DB::table('status_registrations')->truncate();
        }

        DB::table('status_registrations')->insert($data);
    }
}
