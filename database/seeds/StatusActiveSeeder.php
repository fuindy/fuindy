<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusActiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Active'],
            ['name' => 'Inactive'],
            ['name' => 'Block'],
        );

        /* Truncate all the data before populating*/
        if (DB::table('status_actives')->get()->count() > 0) {
            DB::table('status_actives')->truncate();
        }

        DB::table('status_actives')->insert($data);
    }
}
