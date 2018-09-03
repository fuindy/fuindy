<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'Christian'],
            ['name' => 'Islam'],
            ['name' => 'Hindu'],
            ['name' => 'Buddha'],
            ['name' => 'Catholic'],
        );

        if (DB::table('religions')->get()->count() > 0) {
            DB::table('religions')->truncate();
        }

        DB::table('religions')->insert($data);
    }
}
