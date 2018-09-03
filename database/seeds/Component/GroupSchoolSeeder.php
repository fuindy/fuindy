<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            ['name' => 'SD (Sekolah Dasar)'],
            ['name' => 'SMP (Sekolah Menengah Pertama)'],
            ['name' => 'Madrasah'],
            ['name' => 'SMA (Sekolah Menengah Atas)'],
            ['name' => 'SMK (Sekolah Menengah Kejuruan)'],
            ['name' => 'STM (Sekolah Teknik Mesin)']
        );

        /* Truncate all the data before populating*/
        if (DB::table('group_schools')->get()->count() > 0) {
            DB::table('group_schools')->truncate();
        }

        DB::table('group_schools')->insert($data);
    }
}
